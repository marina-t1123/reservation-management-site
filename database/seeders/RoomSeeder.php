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
            1 => [
                'type' => 'シングル',
                'number' => 101,
                'max_people' => 1,
            ],
            2 => [
                'type' => 'シングル',
                'number' => 102,
                'max_people' => 1,
            ],
            3 => [
                'type' => 'ダブル',
                'number' => 201,
                'max_people' => 2,
            ],
            4 => [
                'type' => 'ダブル',
                'number' => 202,
                'max_people' => 2,
            ],
            5 => [
                'type' => 'ツイン',
                'number' => 301,
                'max_people' => 3,
            ],
            6 => [
                'type' => 'ツイン',
                'number' => 302,
                'max_people' => 3,
            ],
        ]);
    }
}
