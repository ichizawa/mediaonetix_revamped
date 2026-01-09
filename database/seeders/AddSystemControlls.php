<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddSystemControlls extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('system_settings')->insert([
            [
                'name' => 'Maintenance Mode',
                'type' => 'maintenance_mode',
                'value' => '1',
            ],
            [
                'name' => 'Ticket Sales',
                'type' => 'ticket_sales',
                'value' => '1',
            ],
            [
                'name' => 'User Registration',
                'type' => 'user_registration',
                'value' => '1',
            ],
            [
                'name' => 'Email Notifications',
                'type' => 'email_notifications',
                'value' => '1',
            ],
        ]);
    }
}
