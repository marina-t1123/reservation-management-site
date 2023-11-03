<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('reservations')->insert([
            // 紐づいている予約枠：シングル・102号室 宿泊プラン：素泊まりプラン 2023-08-25・料金：10000円
            1 => [
                'plan_id' => 2, // 素泊まりプラン
                'guest_id' => 1,
                'checkin_date' => '2023-08-25',
                'checkout_date' => '2023-08-26',
                'memo' => true,
                'cancel_at' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
