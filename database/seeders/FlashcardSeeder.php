<?php

namespace Database\Seeders;

use App\Models\Deck;
use App\Models\Flashcard;
use Illuminate\Database\Seeder;

class FlashcardSeeder extends Seeder
{
    public function run(): void
    {
        $biologyDeck = Deck::where('title', 'Biology Midterm Review')->first();

        if (! $biologyDeck) {
            return;
        }

        $flashcards = [
            [
                'question' => 'What is the basic unit of life?',
                'answer' => 'The cell.',
            ],
            [
                'question' => 'What organelle is known as the powerhouse of the cell?',
                'answer' => 'The mitochondrion.',
            ],
            [
                'question' => 'What process do plants use to convert sunlight into chemical energy?',
                'answer' => 'Photosynthesis.',
            ],
            [
                'question' => 'What is the function of DNA?',
                'answer' => 'DNA stores the genetic instructions for growth, development, and reproduction.',
            ],
            [
                'question' => 'What is homeostasis?',
                'answer' => 'The maintenance of a stable internal environment despite external changes.',
            ],
        ];

        foreach ($flashcards as $card) {

            $flashcard = Flashcard::create([
                'user_id' => $biologyDeck->user_id,
                'question' => $card['question'],
                'answer' => $card['answer'],
            ]);

            $biologyDeck->flashcards()->attach($flashcard->id);
        }
    }
}