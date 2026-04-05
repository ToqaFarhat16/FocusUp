<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        // إنشاء حجز للغرفة الأولى
        $user = User::first();

        // جيب أول غرفة موجودة
        $room = Room::first();

        // إذا في مستخدم وغرفة، أنشئ حجز
        if ($user && $room) {
            Booking::create([
                'user_id' => $user->id,
                'room_id' => $room->id,
                'booking_date' => now()->toDateString(),
                'start_time' => '14:00:00',
                'end_time' => '16:00:00',
                'duration' => '02:00:00',
                'price' => 0,
                'status' => 'confirmed',
            ]);
        }

    }
}
