<?php

namespace Database\Seeders;

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

        $seats = [
            new Seat(),
            new Seat(),
        ];

        $room->seats()->saveMany($seats);
    }
}
