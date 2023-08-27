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
            // シングル・101号室・2023-08-25 ~ 2023-08-27
            1 => [
                'plan_id' => 2,
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
