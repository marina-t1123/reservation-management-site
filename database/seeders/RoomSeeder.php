<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('rooms')->insert([
            // 1:シングル 2:ダブル 3:ツイン
            1 => [
                'type' => 1,
                'number' => 101,
                'max_people' => 1,
            ],
            2 => [
                'type' => 1,
                'number' => 102,
                'max_people' => 1,
            ],
            3 => [
                'type' => 2,
                'number' => 201,
                'max_people' => 2,
            ],
            4 => [
                'type' => 2,
                'number' => 202,
                'max_people' => 2,
            ],
            5 => [
                'type' => 3,
                'number' => 301,
                'max_people' => 3,
            ],
            6 => [
                'type' => 3,
                'number' => 302,
                'max_people' => 3,
            ],
        ]);
    }
}
