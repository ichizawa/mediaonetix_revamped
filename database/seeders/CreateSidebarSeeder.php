<?php

namespace Database\Seeders;

use App\Models\Sidebar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CreateSidebarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    
    {

     DB::table('sidebars')->truncate(); 
        $items = [
            'Events',
            'Sales',
            'Merchants',
            'Users',
            'Control Panel',
            'Staffs',
            'Profile',
            'Settings',
            'Organizer'
        ];

        foreach ($items as $item) {
            Sidebar::create([
                'name' => $item,
                'type' => lcfirst($item),
                'status' => 1,
            ]);
        }
    }
}
