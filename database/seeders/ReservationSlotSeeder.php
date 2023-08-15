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
            // シングル・101号室・2023-08-25 ~ 2023-08-27
            1 => [
                'room_id' => 1,
                'reservation_slot_date' => '2023-08-25',
            ],
            2 => [
                'room_id' => 1,
                'reservation_slot_date' => '2023-08-26',
            ],
            3 => [
                'room_id' => 1,
                'reservation_slot_date' => '2023-08-27',
            ],
            // シングル・102号室・'2023-08-26'
            4 => [
                'room_id' => 2,
                'reservation_slot_date' => '2023-08-26',
            ],
            // ダブル・201号室・'2023-08-25' ~ '2023-08-26'
            5 => [
                'room_id' => 3,
                'reservation_slot_date' => '2023-08-25',
            ],
            6 => [
                'room_id' => 3,
                'reservation_slot_date' => '2023-08-26',
            ],
            // ダブル・202号室・'2023-08-25'
            7 => [
                'room_id' => 4,
                'reservation_slot_date' => '2023-08-25',
            ],
        ]);
    }
}
