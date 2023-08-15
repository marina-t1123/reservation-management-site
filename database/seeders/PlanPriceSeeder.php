<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('plan_prices')->insert([
            // 予約枠：シングル・101号室 宿泊プラン：素泊まりプラン 2023-08-25・料金：10000円
            1 => [
                'reservation_slot_id' => 1,
                'plan_id' => 2,
                'price' => '12000',
            ],
            // 予約枠：シングル・101号室 宿泊プラン：素泊まりプラン 2023-08-26・料金：12000円
            2 => [
                'reservation_slot_id' => 2,
                'plan_id' => 2,
                'price' => '12000',
            ],
            // 予約枠：シングル・101号室 宿泊プラン：ゆったりプラン 2023-08-25・料金：10000円
            3 => [
                'reservation_slot_id' => 1,
                'plan_id' => 1,
                'price' => '10000',
            ],
            // 予約枠：シングル・102号室 宿泊プラン：素泊まりプラン 2023-08-26・料金：12000円
            4 => [
                'reservation_slot_id' => 4,
                'plan_id' => 2,
                'price' => '10000',
            ],
            // 予約枠：ダブル・201号室 宿泊プラン：ゆったりプラン 2023-08-25・料金：24000円
            4 => [
                'reservation_slot_id' => 5,
                'plan_id' => 2,
                'price' => '24000',
            ],
            // 予約枠：ダブル・201号室 宿泊プラン：ゆったりプラン 2023-08-26・料金：24000円
            5 => [
                'reservation_slot_id' => 6,
                'plan_id' => 2,
                'price' => '24000',
            ],
            // 予約枠：シングル・101号室 宿泊プラン：ゆったりプラン 2023-08-25・料金：24000円
            6 => [
                'reservation_slot_id' => 7,
                'plan_id' => 2,
                'price' => '24000',
            ],
        ]);
    }
}
