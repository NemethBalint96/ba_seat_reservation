<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Seat;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $room = Room::create();

        $seat1 = new Seat();
        $room->seats()->save($seat1);

        $seat2 = new Seat();
        $room->seats()->save($seat2);
    }
}
