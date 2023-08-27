<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InquirySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('inquiries')->insert([
            // 予約枠：シングル・101号室 宿泊プラン：素泊まりプラン 2023-08-25・料金：10000円
            1 => [
                'name' => '高津 万里奈',
                'email' => 'takatsu@test.com',
                'subject' => '予約について、キャンセルさせて頂きたいです。',
                'support_status' => 0,
                'created_at' => '2021-08-01 00:00:00',
                'updated_at' => '2021-08-01 00:00:00',
            ]
        ]);
    }
}
