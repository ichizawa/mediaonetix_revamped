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
        $users = User::staffs()->withCount('events')->paginate(10);
        $active = User::active()->staffs()->count();
        $scans =  UserScanner::whereIn('user_id', User::staffs()->pluck('id'))->sum('scanning_count');

        // Attach scans_today to each user (scanning_count from UserScanner)
        $userScans = UserScanner::whereIn('user_id', $users->pluck('id'))->pluck('scanning_count', 'user_id');
        foreach ($users as $user) {
            $user->scans_today = $userScans[$user->id] ?? 0;
        }

        // Get events as id => name for dropdown
        $events = method_exists(Auth::user(), 'events') ? Auth::user()->events()->pluck('event_name', 'id')->toArray() : [];

        return view(auth()->user()->routePrefix() . '.staffs', compact('users', 'active', 'scans', 'events'));
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
}
