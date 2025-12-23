<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Admin', 'type' => 'admin'],
            ['name' => 'Merchant', 'type' => 'merchant'],
            ['name' => 'Staff', 'type' => 'staff'],
            ['name' => 'User', 'type' => 'user'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate($role);
        }
    }
}
