<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('guests')->insert([
            1 => [
                'name' => 'test1',
                'email' => 'test1@test.com',
                'tel' => '09012341234',
                'address' => '東京都江東区',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

    }
}
