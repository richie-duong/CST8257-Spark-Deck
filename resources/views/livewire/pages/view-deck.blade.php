<?php

use App\Models\Deck;
use Livewire\Volt\Component;

new class extends Component
{
    public Deck $deck;
};

?>

<section class="py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="bg-white shadow rounded-lg p-8">

            <h1 class="text-3xl font-bold">
                {{ $deck->title }}
            </h1>

            <p class="mt-3 text-gray-600">
                {{ $deck->description }}
            </p>

            <div class="mt-6 grid grid-cols-2 gap-4">

                <div>
                    <p class="text-sm text-gray-500">Creator</p>
                    <p>{{ $deck->user->name }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Visibility</p>
                    <p>{{ ucfirst($deck->visibility) }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Flashcards</p>
                    <p>{{ $deck->flashcards->count() }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Created</p>
                    <p>{{ $deck->created_at->format('M d, Y') }}</p>
                </div>

            </div>

        </div>

        <div class="mt-8">

            <h2 class="text-2xl font-semibold mb-4">
                Flashcards
            </h2>

            @foreach($deck->flashcards as $flashcard)

                <div class="bg-white shadow rounded-lg p-6 mb-4">

                    <h3 class="font-semibold text-lg">
                        Question
                    </h3>

                    <p class="mt-2">
                        {{ $flashcard->question }}
                    </p>

                    <hr class="my-4">

                    <h3 class="font-semibold text-lg">
                        Answer
                    </h3>

                    <p class="mt-2">
                        {{ $flashcard->answer }}
                    </p>

                </div>

            @endforeach

        </div>

    </div>
</section>