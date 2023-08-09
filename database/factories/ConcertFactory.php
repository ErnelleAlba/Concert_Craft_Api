<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Concert>
 */
class ConcertFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake() -> realText($maxNbChars = 50, $indexSize = 1),
            'poster_image_url' => fake() -> imageUrl(480, 640, 'singer', true),
            'description' => fake() -> realText($maxNbChars = 200, $indexSize = 1),
            'event_date' => fake() -> dateTimeThisYear(),
            'place'  => fake() -> city(),
            'ticket_price' => fake() -> numberBetween(2000, 5000),
        ];
    }
}
