<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffRequest;
use App\Models\User;
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
        $inactive = User::inactive()->staffs()->count();
        $pending = User::pending()->staffs()->count();


        return view(auth()->user()->routePrefix() . '.staffs', compact('users', 'active', 'inactive', 'pending'));
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
            $staff->binded_merchant_id = Auth::user()->id;
            $staff->save();

            Log::info('Staff Created Successfully');

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
