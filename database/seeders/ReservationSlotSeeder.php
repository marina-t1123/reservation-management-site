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
                'is_enabled' => true,
            ],
            2 => [
                'room_id' => 1,
                'reservation_slot_date' => '2023-08-26',
                'is_enabled' => true,
            ],
            3 => [
                'room_id' => 1,
                'reservation_slot_date' => '2023-08-27',
                'is_enabled' => true,
            ],
            // シングル・102号室・2023-08-25
            4 => [
                'room_id' => 2,
                'reservation_slot_date' => '2023-08-25',
                'is_enabled' => false,
            ],
            // ダブル・201号室・2023-08-25 ~ 2023-08-27
            5 => [
                'room_id' => 3,
                'reservation_slot_date' => '2023-08-25',
                'is_enabled' => true,
            ],
            6 => [
                'room_id' => 3,
                'reservation_slot_date' => '2023-08-26',
                'is_enabled' => true,
            ],
            7 => [
                'room_id' => 3,
                'reservation_slot_date' => '2023-08-27',
                'is_enabled' => true,
            ],
            // ダブル・202号室・2023-08-25
            8 => [
                'room_id' => 4,
                'reservation_slot_date' => '2023-08-25',
                'is_enabled' => true,
            ],
        ]);
    }
}
