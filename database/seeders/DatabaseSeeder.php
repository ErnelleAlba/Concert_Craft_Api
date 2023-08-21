<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Booking;
use App\Models\Concert;
use App\Models\Customer;
use App\Models\User;
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
        User::factory()->create([
            'first_name'=> 'admin',
            'last_name'=> 'user',
            'age'=> '20',
            'username'=> 'admin-user',
            'role'=> 'admin',
            'email' => 'admin@example.com',
            'password' => 'admin12345',
            'phone' => '09123456789',
            'address' => 'Somewhere',
        ]); 

        Concert::factory(10) 
        -> hasBookings(5)
        -> create();

        User::factory(10)->create();




        // Booking::factory(25)  -> create();

        // Booking::factory(25) ->
        //     hasCustomer(20)->
        //     hasConcert(5)-> 
        //     create();
    }
}
