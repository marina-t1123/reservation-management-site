<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Guest;
use App\Models\Reservation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            AdminSeeder::class,
            RoomSeeder::class,
            ReservationSlotSeeder::class,
            PlanSeeder::class,
            PlanPriceSeeder::class,
            GuestSeeder::class,
            ReservationSeeder::class,
            ReservationPlanPriceSeeder::class,
            InquirySeeder::class
        ]);
    }
}
