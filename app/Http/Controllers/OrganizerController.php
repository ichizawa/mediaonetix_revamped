<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffRequest;
use App\Models\User;
use App\Models\UserScanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;


class OrganizerController extends Controller
{
    public function index()
    {
        $users = User::staffs()->where(function ($query) {
            if (Auth::user()->isMerchant()) {
                $query->where('binded_merchant_id', Auth::user()->id);
            } elseif (Auth::user()->isOrganizer() && Auth::user()->binded_merchant_id) {
                $query->where('binded_merchant_id', Auth::user()->binded_merchant_id);
            }
        })->get();
        if (Auth::user()->isMerchant()) {
            $total_staffs = User::staffs()->where('binded_merchant_id', Auth::user()->id)->count();
        } elseif (Auth::user()->isOrganizer() && Auth::user()->binded_merchant_id) {
            $total_staffs = User::staffs()->where('binded_merchant_id', Auth::user()->binded_merchant_id)->count();
        } else {
            $total_staffs = User::staffs()->count(); // Admin or fallback
        }
        $active = User::active()->staffs()->where(function ($query) {
            if (Auth::user()->isMerchant()) {
                $query->where('binded_merchant_id', auth()->id());
            } elseif (Auth::user()->isOrganizer() && Auth::user()->binded_merchant_id) {
                $query->where('binded_merchant_id', Auth::user()->binded_merchant_id);
            }
        })->count();
        $scans =  UserScanner::whereIn('user_id', $users->pluck('id'))->sum('scanning_count');
        // Only count access for staff under the merchant or assigned merchant
        if (Auth::user()->isMerchant()) {
            $access = UserScanner::whereIn('user_id', User::staffs()->where('binded_merchant_id', Auth::user()->id)->pluck('id'))->count();
        } elseif (Auth::user()->isOrganizer() && Auth::user()->binded_merchant_id) {
            $access = UserScanner::whereIn('user_id', User::staffs()->where('binded_merchant_id', Auth::user()->binded_merchant_id)->pluck('id'))->count();
        } else {
            $access = UserScanner::whereIn('user_id', User::staffs()->pluck('id'))->count();
        }

        // Attach scans_today to each user (scanning_count from UserScanner)
        $userScans = UserScanner::whereIn('user_id', $users->pluck('id'))->pluck('scanning_count', 'user_id');
        foreach ($users as $user) {
            $user->scans_today = $userScans[$user->id] ?? 0;
        }

        // Get events as id => name for dropdown
        $events = method_exists(Auth::user(), 'events') ? Auth::user()->events()->pluck('event_name', 'id')->toArray() : [];

        return view(Auth::user()->routePrefix() . '.staffs', compact('users', 'total_staffs', 'active', 'scans', 'events', 'access'));
    }

    public function store(StaffRequest $request)
    {

        try {
            DB::beginTransaction();


            $data = $request->validated();


            $staff = new User();
            $staff->name = $data['first_name'] . ' ' . $data['last_name'];
            $staff->email = $data['email'];
            $staff->username = $data['username'];
            $staff->first_name = $data['first_name'];
            $staff->last_name = $data['last_name'];
            $staff->phone_number = $data['phone_number'];
            $staff->password = Hash::make($data['password']);
            $staff->role_id = 3;
            $staff->is_active = 1;
            $staff->email_verified_at = now();
            $staff->event_id = $data['event_id'];
            $staff->binded_merchant_id = Auth::user()->id;
            $staff->save();

            Log::info('Staff Created Successfully');

            $user_scanner = new \App\Models\UserScanner();
            $user_scanner->user_id = $staff->id;
            $user_scanner->security_pin = Hash::make($data['security_pin']);
            $user_scanner->save();


            // Save each permission as a separate record
            foreach ($data['permission_name'] as $permission) {
                $user_permission = new \App\Models\UserPermission();
                $user_permission->user_id = $staff->id;
                $user_permission->role_id = 3;
                $user_permission->permission_name = $permission;
                $user_permission->save();
            }

            DB::commit();
            return back()->with('success', 'Staff Created Successfully');
        } catch (ValidationException $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function update(StaffRequest $request, $id)
    {
        try {
            $staff = User::findOrFail($id);
            $data = $request->validated();

            $staff->name = $data['first_name'] . ' ' . $data['last_name'];
            $staff->email = $data['email'];
            $staff->username = $data['username'];
            $staff->first_name = $data['first_name'];
            $staff->last_name = $data['last_name'];
            $staff->phone_number = $data['phone_number'];
            if (!empty($data['password'])) {
                $staff->password = Hash::make($data['password']);
            }
            if (!empty($data['security_pin'])) {
                UserScanner::updateOrCreate(
                    ['user_id' => $staff->id],
                    ['security_pin' => Hash::make($data['security_pin'])]
                );
            }
            $staff->event_id = $data['event_id'];
            $staff->save();

            // Update permissions only if present
            if (isset($data['permission_name']) && is_array($data['permission_name'])) {
                \App\Models\UserPermission::where('user_id', $staff->id)->delete();
                foreach ($data['permission_name'] as $permission) {
                    $user_permission = new \App\Models\UserPermission();
                    $user_permission->user_id = $staff->id;
                    $user_permission->role_id = 3;
                    $user_permission->permission_name = $permission;
                    $user_permission->save();
                }
            }

            Log::info('Staff Updated Successfully');
            return back()->with('success', 'Staff Updated Successfully');
        } catch (ValidationException $e) {
            Log::error($e->getMessage());
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->withErrors($e->getMessage())->withInput();
        }
    }


    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return back()->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->withErrors($e->getMessage());
        }
    }
}
