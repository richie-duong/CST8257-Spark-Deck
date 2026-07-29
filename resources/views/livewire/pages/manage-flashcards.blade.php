<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

        {{-- Page header --}}
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold text-gray-800">
                Manage Flashcards — {{ $deck->title }}
            </h1>
            <a href="{{ route('decks.study', $deck) }}"
               class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 transition">
                ▶ Study Deck
            </a>
        </div>

        {{-- Flash success message --}}
        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        {{-- Create / Edit Form --}}
        <div class="bg-white shadow-sm rounded-lg p-6">

            @if (! $editingFlashcardId)
                <button wire:click="toggleCreateForm"
                        class="mb-4 inline-flex items-center px-4 py-2 bg-gray-800 text-white text-sm font-medium rounded-md hover:bg-gray-700 transition">
                    {{ $showCreateForm ? '✕ Cancel' : '+ New Flashcard' }}
                </button>
            @endif

            @if ($showCreateForm && ! $editingFlashcardId)
                <form wire:submit="createFlashcard" class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-800">New Flashcard</h3>

                    <div>
                        <x-input-label for="question" value="Question" />
                        <textarea id="question" wire:model="question" rows="3"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                  placeholder="Enter the question…"></textarea>
                        <x-input-error :messages="$errors->get('question')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="answer" value="Answer" />
                        <textarea id="answer" wire:model="answer" rows="3"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                  placeholder="Enter the answer…"></textarea>
                        <x-input-error :messages="$errors->get('answer')" class="mt-1" />
                    </div>

                    <div class="flex gap-3">
                        <x-primary-button type="submit">Save Flashcard</x-primary-button>
                        <x-secondary-button wire:click="toggleCreateForm" type="button">Cancel</x-secondary-button>
                    </div>
                </form>
            @endif

            @if ($editingFlashcardId)
                <form wire:submit="updateFlashcard" class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-800">Edit Flashcard</h3>

                    <div>
                        <x-input-label for="edit-question" value="Question" />
                        <textarea id="edit-question" wire:model="question" rows="3"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                        <x-input-error :messages="$errors->get('question')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="edit-answer" value="Answer" />
                        <textarea id="edit-answer" wire:model="answer" rows="3"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                        <x-input-error :messages="$errors->get('answer')" class="mt-1" />
                    </div>

                    <div class="flex gap-3">
                        <x-primary-button type="submit">Update Flashcard</x-primary-button>
                        <x-secondary-button wire:click="cancelEditing" type="button">Cancel</x-secondary-button>
                    </div>
                </form>
            @endif
        </div>

        {{-- Flashcard List --}}
        <div class="bg-white shadow-sm rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                Flashcards
                <span class="ml-2 text-sm font-normal text-gray-500">({{ $flashcards->count() }})</span>
            </h3>

            @if ($flashcards->isEmpty())
                <p class="text-gray-500 text-sm">No flashcards yet. Add one above.</p>
            @else
                <ul class="divide-y divide-gray-100">
                    @foreach ($flashcards as $flashcard)
                        <li class="py-4 {{ $editingFlashcardId === $flashcard->id ? 'bg-indigo-50 -mx-6 px-6 rounded' : '' }}">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-800">
                                        Q: {{ $flashcard->question }}
                                    </p>
                                    <p class="text-sm text-gray-500 mt-1">
                                        A: {{ $flashcard->answer }}
                                    </p>
                                </div>
                                <div class="flex items-center gap-2 shrink-0">
                                    <button wire:click="startEditing({{ $flashcard->id }})"
                                            class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                                        Edit
                                    </button>
                                    <button wire:click="removeFromDeck({{ $flashcard->id }})"
                                            wire:confirm="Remove this flashcard from the deck?"
                                            class="text-sm text-yellow-600 hover:text-yellow-800 font-medium">
                                        Remove
                                    </button>
                                    <button wire:click="deleteFlashcard({{ $flashcard->id }})"
                                            wire:confirm="Permanently delete this flashcard? This cannot be undone."
                                            class="text-sm text-red-600 hover:text-red-800 font-medium">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

    </div>
</div>