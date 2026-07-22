<?php

namespace Database\Factories;

use App\Models\Deck;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends Factory<Deck>
 */
class DeckFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'user_id' => User::inRandomOrder()->value('id'),
        'title' => fake()->sentence(3),
        'description' => fake()->paragraph(),
        'visibility' => fake()->randomElement([
            'public',
            'private',
        ]),
    ];
}
}
