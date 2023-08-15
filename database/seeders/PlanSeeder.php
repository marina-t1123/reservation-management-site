<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run()
    {
        \DB::table('plans')->insert([
            1 => [
                'title' => 'ゆったりプラン',
                'explanation' => 'ゆったり泊まれるプランです。',
            ],
            2 => [
                'title' => '素泊まりプラン',
                'explanation' => '素泊まりで泊まれるプランです。',
            ],
        ]);
    }
}
