<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'System Administrator',
                'email' => 'admin@gmail.com',
                'username' => 'admin',
                'first_name' => 'System',
                'last_name' => 'Administrator',
                'phone_number' => 9123456789,
                'city' => 'Davao City',
                'country' => 'Philippines',
                'zip_code' => 8000,
                'address' => 'Admin Address',
                'dob' => '1998-01-01',
                'gender' => 1,
                'is_active' => true,
                'is_email_sent' => true,
                'is_email_resent' => false,
                'role_id' => Role::where('type', 'admin')->first()->id,
                'password' => Hash::make('12345678'),
                'verified_at' => now(),
            ]
        );
        User::firstOrCreate(
            ['email' => 'merchant@gmail.com'],
            [
                'name' => 'System Merchant',
                'email' => 'merchant@gmail.com',
                'username' => 'merchant',
                'first_name' => 'System',
                'last_name' => 'Merchant',
                'phone_number' => 9123456789,
                'city' => 'Davao City',
                'country' => 'Philippines',
                'zip_code' => 8000,
                'address' => 'Admin Address',
                'dob' => '1998-01-01',
                'gender' => 1,
                'is_active' => true,
                'is_email_sent' => true,
                'is_email_resent' => false,
                'role_id' => Role::where('type', 'merchant')->first()->id,
                'password' => Hash::make('12345678'),
                'verified_at' => now(),
            ]
        );
        User::firstOrCreate(
            ['email' => 'staff@gmail.com'],
            [
                'name' => 'System Staff',
                'email' => 'staff@gmail.com',
                'username' => 'staff',
                'first_name' => 'System',
                'last_name' => 'Staff',
                'phone_number' => 9123456789,
                'city' => 'Davao City',
                'country' => 'Philippines',
                'zip_code' => 8000,
                'address' => 'Staff Address',
                'dob' => '1998-01-01',
                'gender' => 1,
                'is_active' => true,
                'is_email_sent' => true,
                'is_email_resent' => false,
                'role_id' => Role::where('type', 'staff')->first()->id,
                'password' => Hash::make('12345678'),
                'verified_at' => now(),
            ]
        );
        User::firstOrCreate(
            ['email' => 'customer@gmail.com'],
            [
                'name' => 'System Customer',
                'email' => 'customer@gmail.com',
                'username' => 'customer',
                'first_name' => 'System',
                'last_name' => 'Customer',
                'phone_number' => 9123456789,
                'city' => 'Davao City',
                'country' => 'Philippines',
                'zip_code' => 8000,
                'address' => 'Customer Address',
                'dob' => '1998-01-01',
                'gender' => 1,
                'is_active' => true,
                'is_email_sent' => true,
                'is_email_resent' => false,
                'role_id' => Role::where('type', 'user')->first()->id,
                'password' => Hash::make('12345678'),
                'verified_at' => now(),
            ]
        );
    }
}
