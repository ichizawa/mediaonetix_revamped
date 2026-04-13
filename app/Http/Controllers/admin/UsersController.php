<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Models\Role;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();

        $active_users = User::where('is_active', 1)->count();
        $pending_user = User::where('role_id', 2)->where('is_active', 2)->count();
        $inactive_user = User::where('role_id', 2)->where('is_active', 0)->count();

        return view('admin.users', compact('users', 'active_users', 'pending_user', 'inactive_user'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'email' => 'required|email',
                'username' => 'required|string',
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'phone_number' => 'required|string',
                'password' => 'required|string|confirmed',
                'city' => 'required|string',
                'gender' => 'required|string',
                'country' => 'required|string',
                'zip_code' => 'required|string',
                'address' => 'required|string',
                'dob' => 'required|date',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'role_id' => 'required|exists:roles,id'
            ]);

            $genderMap = [
                'male' => 0,
                'female' => 1,
                'other' => 2,
            ];

            $imageName = '';

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/users'), $imageName);
            }
            $role = Role::find($request->role_id);

            $user = new User();
            // Set the name field based on the role name, fallback to 'Unknown' if not found
            $user->name = $role ? $role->name : 'Unknown';
            $user->email = $request->email;
            $user->username = $request->username;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->phone_number = $request->phone_number;
            $user->password = Hash::make($request->password);
            $user->city = $request->city;
            $user->gender = $genderMap[$request->gender];
            $user->country = $request->country;
            $user->zip_code = $request->zip_code;
            $user->address = $request->address;
            $user->is_active = 1;
            $user->role_id = $request->role_id;


            $user->save();


            DB::commit();

            return back()->with('success', 'User created successfully');
        } catch (ValidationException $e) {
            DB::rollBack();
            Log::error($e->errors());
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $user = User::findOrFail($id);

            $request->validate([
                'email' => 'required|email',
                'username' => 'required|string',
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'phone_number' => 'required|string',
                'city' => 'required|string',
                'gender' => 'required|string',
                'country' => 'required|string',
                'zip_code' => 'required|string',
                'address' => 'required|string',
                'dob' => 'required|date',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'role_id' => 'required|exists:roles,id'
            ]);

            $genderMap = [
                'male' => 0,
                'female' => 1,
                'other' => 2,
            ];

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/users'), $imageName);
                $user->image = $imageName;
            }
            $role = Role::find($request->role_id);
            // Update the name field based on the role name, fallback to 'Unknown' if not found
            $user->name = $role ? $role->name : 'Unknown';
            $user->email = $request->email;
            $user->username = $request->username;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->phone_number = $request->phone_number;
            $user->city = $request->city;
            $user->dob = $request->dob;
            $user->gender = $genderMap[$request->gender];
            $user->country = $request->country;
            $user->zip_code = $request->zip_code;
            $user->address = $request->address;
            $user->role_id = $request->role_id;
            $user->save();

            Log::info('Merchant Updated Successfully');

            DB::commit();
            return back()->with('success', 'Merchant Updated Successfully');
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

    public function delete($id)
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
