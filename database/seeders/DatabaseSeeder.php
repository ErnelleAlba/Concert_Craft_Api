<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Booking;
use App\Models\Concert;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Concert::factory(5) 
        -> hasBookings(5)
        -> create();



        // Booking::factory(25)  -> create();

        // Booking::factory(25) ->
        //     hasCustomer(20)->
        //     hasConcert(5)-> 
        //     create();
    }
}
