<?php

namespace Database\Seeders;

use App\Models\Events;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Events::insert([
            [
                'event_name' => 'Summer Music Festival',
                'category' => 'Music',
                'description' => 'A fun outdoor music festival featuring local bands.',
                'event_image' => 'summer_festival.jpg', // optional
                'event_date' => '2026-03-15',
                'event_time' => '18:00:00',
                'event_venue' => 'City Park Amphitheater',
                'event_total_tickets' => 500,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'event_name' => 'Art Expo 2026',
                'category' => 'Exhibition',
                'description' => 'An exhibition showcasing modern art from emerging artists.',
                'event_image' => 'art_expo.jpg',
                'event_date' => '2026-04-10',
                'event_time' => '10:00:00',
                'event_venue' => 'Downtown Gallery',
                'event_total_tickets' => 200,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
