<?php

namespace Database\Seeders;

use App\Models\Deck;
use App\Models\User;
use Illuminate\Database\Seeder;

class DeckSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        $sampleDecks = [

            // Programming
            [
                'title' => 'HTML Fundamentals',
                'description' => 'Learn the structure of HTML documents and common elements.',
                'visibility' => 'public',
            ],
            [
                'title' => 'CSS Flexbox & Grid',
                'description' => 'Master responsive layouts using Flexbox and CSS Grid.',
                'visibility' => 'public',
            ],
            [
                'title' => 'JavaScript Basics',
                'description' => 'Variables, functions, arrays, loops, and DOM manipulation.',
                'visibility' => 'public',
            ],
            [
                'title' => 'Laravel Essentials',
                'description' => 'Routing, Blade, Eloquent, middleware, and authentication.',
                'visibility' => 'public',
            ],
            [
                'title' => 'PHP Review',
                'description' => 'PHP syntax, arrays, forms, sessions, and object-oriented programming.',
                'visibility' => 'private',
            ],

            // School
            [
                'title' => 'Database Systems',
                'description' => 'Normalization, SQL queries, joins, indexes, and ER diagrams.',
                'visibility' => 'public',
            ],
            [
                'title' => 'Networking Concepts',
                'description' => 'TCP/IP, DNS, routing, switching, and common protocols.',
                'visibility' => 'public',
            ],
            [
                'title' => 'Operating Systems',
                'description' => 'Processes, threads, scheduling, memory management, and file systems.',
                'visibility' => 'private',
            ],
            [
                'title' => 'Software Testing',
                'description' => 'Unit testing, integration testing, system testing, and QA principles.',
                'visibility' => 'public',
            ],
            [
                'title' => 'UX Design Principles',
                'description' => 'Accessibility, usability, user-centered design, and wireframing.',
                'visibility' => 'public',
            ],

            // Science
            [
                'title' => 'Biology Midterm Review',
                'description' => 'Cells, mitosis, genetics, evolution, and ecosystems.',
                'visibility' => 'public',
            ],
            [
                'title' => 'Chemistry Basics',
                'description' => 'Periodic table, bonding, chemical reactions, and acids/bases.',
                'visibility' => 'public',
            ],
            [
                'title' => 'Physics Mechanics',
                'description' => 'Motion, force, energy, momentum, and Newton\'s Laws.',
                'visibility' => 'private',
            ],

            // Math
            [
                'title' => 'Calculus I',
                'description' => 'Limits, derivatives, optimization, and curve sketching.',
                'visibility' => 'public',
            ],
            [
                'title' => 'Statistics Review',
                'description' => 'Mean, median, probability, distributions, and hypothesis testing.',
                'visibility' => 'public',
            ],

            // Languages
            [
                'title' => 'Japanese Vocabulary',
                'description' => 'Basic greetings, numbers, common verbs, and everyday phrases.',
                'visibility' => 'public',
            ],
            [
                'title' => 'French Basics',
                'description' => 'Common expressions, greetings, food, and travel vocabulary.',
                'visibility' => 'private',
            ],
        ];

        foreach ($sampleDecks as $deck) {
            Deck::create([
                'user_id' => $users->random()->id,
                'title' => $deck['title'],
                'description' => $deck['description'],
                'visibility' => $deck['visibility'],
            ]);
        }
    }
}