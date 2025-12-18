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
        $adminRole = Role::where('name', 'Admin')->first();

        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'System Administrator',
                'email' => 'admin@example.com',
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
                'role_id' => $adminRole?->id,
                'password' => Hash::make('12345678'),
            ]
        );
    }
}
