<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            ['name' => 'القاعة الهادئة A', 'type' => 'quiet', 'capacity' => 40, 'status' => 'active'],
            ['name' => 'القاعة الهادئة B', 'type' => 'quiet', 'capacity' => 30, 'status' => 'active'],
            ['name' => 'القاعة الاجتماعية (مدخنين)', 'type' => 'social_smoking', 'capacity' => 50, 'status' => 'active'],
            ['name' => 'القاعة الاجتماعية (غير مدخنين)', 'type' => 'social_no_smoking', 'capacity' => 60, 'status' => 'active'],
            ['name' => 'قاعة النقاش', 'type' => 'discussion', 'capacity' => 25, 'status' => 'active'],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }

}
