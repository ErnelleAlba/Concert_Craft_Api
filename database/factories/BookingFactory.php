<?php

namespace Database\Factories;

use App\Models\Concert;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'concert_id' => Concert::factory(),
            'seat_position' => fake()->randomElement(['vip_seat', 'premium_seat', 'regular_seat']),
            'no_of_tickets' => fake()->numberBetween(1,9),
            'total_price' => fake()->numberBetween(2000,50000),
        ];
    }
}
