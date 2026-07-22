<?php

namespace Database\Seeders;

use App\Models\Deck;
use App\Models\Flashcard;
use App\Models\User;
use Illuminate\Database\Seeder;

class DeckSeeder extends Seeder
{
    public function run(): void
    {
        Deck::factory(20)->create();

        Deck::all()->each(function ($deck) {

            $deck->flashcards()->attach(
                Flashcard::inRandomOrder()
                    ->take(rand(5, 15))
                    ->pluck('id')
            );

        });
    }
}