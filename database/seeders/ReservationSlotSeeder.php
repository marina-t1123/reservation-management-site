<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('reservation_slots')->insert([
            1 => [
                'room_id' => 1,
                'reservation_slot_date' => now(),
            ],
            2 => [
                'room_id' => 2,
                'reservation_slot_date' => now(),
            ],
            3 => [
                'type' => '3',
                'reservation_slot_date' => now(),
            ],
            4 => [
                'type' => '5',
                'reservation_slot_date' => now(),
            ],
        ]);
    }
}
