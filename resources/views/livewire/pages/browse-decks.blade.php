<?php

use App\Models\Deck;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public string $search = '';
    public string $sort = 'newest';

    public function getDecksProperty()
    {
        return Deck::where('visibility', 'public')

            ->when(trim($this->search), function ($query) {

                $search = trim($this->search);

                $query->where(function ($query) use ($search) {

                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");

                });

            })

            ->withCount('voters')

            ->when($this->sort === 'newest', function ($query) {
                $query->latest();
            })

            ->when($this->sort === 'oldest', function ($query) {
                $query->oldest();
            })

            ->when($this->sort === 'popular', function ($query) {
                $query->orderByDesc('voters_count');
            })

            ->with('user', 'flashcards', 'voters')

            ->get();

    }

    public function toggleUpvote(int $deckId): void
    {
        if (! Auth::check()) {
            return;
        }

        $deck = Deck::findOrFail($deckId);

        if ($deck->user_id === Auth::id()) {
            return;
        }

        if ($deck->voters()->where('user_id', Auth::id())->exists()) {

            $deck->voters()->detach(Auth::id());

        } else {

            $deck->voters()->attach(Auth::id());

        }

        unset($this->decks);
    }
};

?>

<section class="py-12">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <header>

            <h1 class="text-2xl font-semibold text-gray-900">
                Discover Community Decks
            </h1>

            <p class="mt-1 text-sm text-gray-600">
                Explore decks shared by other learners and find new material to study.
            </p>

        </header>

        <section class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

            <div class="p-6 sm:p-8 space-y-6">

                <div>

                    <label
                        for="search"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Search Public Decks
                    </label>

                    <input
                        id="search"
                        type="search"
                        wire:model.live.debounce.300ms="search"
                        placeholder="Search by title or description..."
                        class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    >

                </div>

                <div>

                    <p class="text-sm font-medium text-gray-700">
                        Filter By
                    </p>

                    <div class="mt-3 flex flex-wrap gap-3">

                        <flux:button
                            wire:click="$set('sort', 'newest')"
                            :variant="$sort === 'newest' ? 'primary' : 'ghost'"
                            size="sm"
                        >
                            Newest
                        </flux:button>

                        <flux:button
                            wire:click="$set('sort', 'oldest')"
                            :variant="$sort === 'oldest' ? 'primary' : 'ghost'"
                            size="sm"
                        >
                            Oldest
                        </flux:button>

                        <flux:button
                            wire:click="$set('sort', 'popular')"
                            :variant="$sort === 'popular' ? 'primary' : 'ghost'"
                            size="sm"
                        >
                            Most Upvoted
                        </flux:button>

                    </div>

                </div>

            </div>

        </section>

        <div class="flex items-center justify-between">

            <h2 class="text-lg font-medium text-gray-900">
                Public Decks
            </h2>

            <p class="text-sm text-gray-500">
                {{ $this->decks->count() }}
                deck{{ $this->decks->count() == 1 ? '' : 's' }}
            </p>

        </div>

                @if ($this->decks->isEmpty())

            <div class="rounded-lg bg-white p-8 shadow-sm text-center">

                <h3 class="text-lg font-medium text-gray-900">
                    No decks found
                </h3>

                <p class="mt-2 text-sm text-gray-600">
                    Try a different search term.
                </p>

            </div>

        @else

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">

                @foreach ($this->decks as $deck)

                    <article class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200 hover:shadow-md transition">

                        <div class="flex items-start justify-between gap-4">

                            <h3 class="text-lg font-semibold text-gray-900">
                                {{ $deck->title }}
                            </h3>

                            @auth

                                @if ($deck->user_id !== auth()->id())

                                    <button
                                        wire:click="toggleUpvote({{ $deck->id }})"
                                        class="flex items-center gap-1 text-sm font-medium transition
                                            {{ $deck->voters->contains(auth()->id())
                                                ? 'text-blue-600'
                                                : 'text-gray-500 hover:text-blue-600' }}"
                                        title="{{ $deck->voters->contains(auth()->id()) ? 'Remove upvote' : 'Upvote this deck' }}"
                                    >
                                        👍 {{ $deck->voters->count() }}
                                    </button>

                                @else

                                    <div
                                        class="flex items-center gap-1 text-sm text-gray-400"
                                        title="You cannot upvote your own deck."
                                    >
                                        👍 {{ $deck->voters->count() }}
                                    </div>

                                @endif

                            @else

                                <div
                                    class="flex items-center gap-1 text-sm text-gray-500"
                                    title="Sign in to upvote decks."
                                >
                                    👍 {{ $deck->voters->count() }}
                                </div>

                            @endauth

                        </div>

                        <p class="mt-3 text-sm text-gray-600">
                            {{ $deck->description ?: 'No description available.' }}
                        </p>

                        <div class="mt-5 space-y-2 text-sm text-gray-500">

                            <p>
                                <strong>Created By:</strong>
                                {{ $deck->user->name }}
                            </p>

                            <p>
                                <strong>Visibility:</strong>
                                {{ ucfirst($deck->visibility) }}
                            </p>

                            <p>
                                <strong>Flashcards:</strong>
                                {{ $deck->flashcards->count() }}
                            </p>

                        </div>

                        <div class="mt-6">

                            <flux:button
                                as="a"
                                href="{{ route('view-deck', $deck) }}"
                                variant="primary"
                                class="w-full"
                            >
                                View Deck
                            </flux:button>

                        </div>

                    </article>

                @endforeach

            </div>

        @endif

    </div>

</section>