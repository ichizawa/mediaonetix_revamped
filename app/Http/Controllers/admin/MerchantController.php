<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MerchantRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class MerchantController extends Controller
{
    public function index()
    {
        $users = User::merchants()->withCount('events')->paginate(10);
        $active = User::active()->merchants()->count();
        $inactive = User::inactive()->merchants()->count();
        $pending = User::pending()->merchants()->count();
        return view('admin.merchants', compact('users', 'active', 'inactive', 'pending'));
    }
    public function store(MerchantRequest $request)
    {
        try {
            DB::beginTransaction();

            $genderMap = [
                'male' => 0,
                'female' => 1,
                'other' => 2,
            ];

            $data = $request->validated();

            $merchant = new User();
            $merchant->name = $data['name'];
            $merchant->email = $data['email'];
            $merchant->username = $data['username'];
            $merchant->first_name = $data['first_name'];
            $merchant->last_name = $data['last_name'];
            $merchant->phone_number = $data['phone_number'];
            $merchant->city = $data['city'];
            $merchant->dob = $data['dob'];
            $merchant->gender = $genderMap[$data['gender']];
            $merchant->country = $data['country'];
            $merchant->zip_code = $data['zip_code'];
            $merchant->address = $data['address'];

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/merchants'), $imageName);
                $merchant->image = $imageName;
            }

            $merchant->email = $data['email'];
            $merchant->password = $data['password'];
            $merchant->is_active = 1;
            $merchant->role_id = Role::where('type', 'merchant')->first()->id;
            $merchant->password = Hash::make($data['password']);
            $merchant->save();

            Log::info('Merchant Created Successfully');

            DB::commit();
            return back()->with('success', 'Merchant Created Successfully');
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
    public function files()
    {
        return view('admin.component.merchant.files.files');
    }
}
