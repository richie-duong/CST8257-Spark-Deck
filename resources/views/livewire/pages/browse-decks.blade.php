<?php

use App\Models\Deck;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public string $search = '';

    public string $sort = 'newest';

    public string $filter = 'all';

    public function getDecksProperty()
    {
        return Deck::query()
            ->where('visibility', 'public')

            // Search
            ->when(trim($this->search) !== '', function ($query) {
                $search = trim($this->search);

                $query->where(function ($query) use ($search) {
                    $query
                        ->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })

            // Sorting
            ->when($this->sort === 'newest', function ($query) {
                $query->latest();
            })

            ->when($this->sort === 'oldest', function ($query) {
                $query->oldest();
            })

            ->when($this->sort === 'popular', function ($query) {
                $query
                    ->withCount('voters')
                    ->orderByDesc('voters_count');
            })

            // Liked filter
            ->when(
                $this->filter === 'liked' && Auth::check(),
                function ($query) {
                    $query->whereHas('voters', function ($query) {
                        $query->where('users.id', Auth::id());
                    });
                }
            )

            // Completed filter
            ->when(
                $this->filter === 'completed' && Auth::check(),
                function ($query) {
                    $query->whereHas('completedBy', function ($query) {
                        $query->where('users.id', Auth::id());
                    });
                }
            )

            ->with([
                'user',
                'flashcards',
                'voters',
                'completedBy',
            ])

            ->get();
    }

    public function toggleUpvote(int $deckId): void
    {
        if (! Auth::check()) {
            return;
        }

        $deck = Deck::findOrFail($deckId);

        // Users cannot upvote their own decks.
        if ($deck->user_id === Auth::id()) {
            return;
        }

        $alreadyVoted = $deck
            ->voters()
            ->where('user_id', Auth::id())
            ->exists();

        if ($alreadyVoted) {
            $deck->voters()->detach(Auth::id());
        } else {
            $deck->voters()->attach(Auth::id());
        }

        // Refresh the deck collection.
        unset($this->decks);
    }

    public function resetFilters(): void
    {
        $this->search = '';
        $this->sort = 'newest';
        $this->filter = 'all';
    }
};

?>

<section class="relative overflow-hidden bg-gradient-to-br from-cyan-50 via-white to-indigo-50 py-16 sm:py-20">

    <!-- Decorative Background -->

    <div class="pointer-events-none absolute inset-0 overflow-hidden">

        <div class="absolute -left-24 top-12 h-96 w-96 rounded-full bg-cyan-200/40 blur-3xl"></div>

        <div class="absolute right-0 top-0 h-[500px] w-[500px] rounded-full bg-indigo-200/40 blur-3xl"></div>

    </div>


    <!-- Main Content -->

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">


        <!-- Hero -->

        <div class="max-w-3xl">

            <span class="inline-flex items-center rounded-full bg-cyan-100 px-4 py-2 text-sm font-semibold text-cyan-700">
                🌎 Community Library
            </span>

            <h1 class="mt-6 text-5xl font-bold tracking-tight text-slate-900">
                Browse Community Decks
            </h1>

            <p class="mt-6 text-lg leading-8 text-slate-600">
                Discover flashcard decks created by learners around the world.
                Search thousands of study cards, explore popular topics,
                and prepare smarter with Spark Deck.
            </p>

        </div>


        <!-- Search & Filters -->

        <div class="mt-12 rounded-3xl border border-slate-200 bg-white/90 p-8 shadow-xl backdrop-blur">

            <!-- Search -->

            <div class="flex flex-col gap-4 sm:flex-row sm:items-end">

                <div class="flex-1">

                    <label
                        for="search"
                        class="block text-sm font-semibold text-slate-700"
                    >
                        Search Public Decks
                    </label>

                    <input
                        id="search"
                        type="search"
                        wire:model.live.debounce.300ms="search"
                        placeholder="Search by title or description..."
                        class="mt-4 block w-full rounded-2xl border border-slate-200 bg-white px-6 py-4 text-lg shadow-sm transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-200"
                    >

                </div>


                <!-- Result Count -->

                <div class="shrink-0 rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 text-center sm:min-w-[140px]">

                    <span class="block text-2xl font-bold text-indigo-600">
                        {{ $this->decks->count() }}
                    </span>

                    <span class="text-sm text-slate-500">
                        {{ $this->decks->count() === 1 ? 'deck' : 'decks' }} found
                    </span>

                </div>

            </div>


            <div class="mt-4 flex flex-wrap items-center gap-3">

    <!-- Sorting -->

    <flux:button
        wire:click="$set('sort', 'newest')"
        :variant="$sort === 'newest' ? 'primary' : 'ghost'"
        class="rounded-full"
    >
        🕒 Newest
    </flux:button>

    <flux:button
        wire:click="$set('sort', 'popular')"
        :variant="$sort === 'popular' ? 'primary' : 'ghost'"
        class="rounded-full"
    >
        🔥 Most Popular
    </flux:button>

    <flux:button
        wire:click="$set('sort', 'oldest')"
        :variant="$sort === 'oldest' ? 'primary' : 'ghost'"
        class="rounded-full"
    >
        📅 Oldest
    </flux:button>


    <!-- Divider -->

    <div class="mx-1 hidden h-8 w-px bg-slate-200 sm:block"></div>


    <!-- Filters -->

    <flux:button
        wire:click="$set('filter', 'all')"
        :variant="$filter === 'all' ? 'primary' : 'ghost'"
        class="rounded-full"
    >
        All Decks
    </flux:button>

    @auth

        <flux:button
            wire:click="$set('filter', 'liked')"
            :variant="$filter === 'liked' ? 'primary' : 'ghost'"
            class="rounded-full"
        >
            👍 Liked
        </flux:button>

        <flux:button
            wire:click="$set('filter', 'completed')"
            :variant="$filter === 'completed' ? 'primary' : 'ghost'"
            class="rounded-full"
        >
            ✓ Completed
        </flux:button>

    @endauth


    <!-- Reset -->

    <div class="mx-1 hidden h-8 w-px bg-slate-200 sm:block"></div>

    <flux:button
        wire:click="resetFilters"
        variant="ghost"
        icon="arrow-path"
        class="rounded-full"
    >
        Reset
    </flux:button>

</div>

        </div>


        <!-- Deck Results -->

        <div class="mt-12">

            @if ($this->decks->isEmpty())

                <!-- Empty State -->

                <div class="rounded-3xl border border-slate-200 bg-white/90 p-12 text-center shadow-xl">

                    <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-cyan-100 text-5xl">
                        📚
                    </div>

                    <h3 class="mt-8 text-3xl font-bold text-slate-900">
                        No Decks Found
                    </h3>

                    <p class="mx-auto mt-4 max-w-lg text-lg text-slate-600">
                        We couldn't find any public decks matching your search.
                        Try another keyword, filter, or browse the newest community decks.
                    </p>

                </div>

            @else

                <!-- Deck Grid -->

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

                    @foreach ($this->decks as $deck)

                        @php
                            $isLiked = Auth::check()
                                && $deck->voters->contains('id', Auth::id());

                            $isCompleted = Auth::check()
                                && $deck->completedBy->contains('id', Auth::id());
                        @endphp


                        <!-- Deck Card -->

                        <article
                            wire:key="deck-{{ $deck->id }}"
                            class="group rounded-3xl border p-7 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl
                                {{ $isCompleted
                                    ? 'border-emerald-200 bg-gradient-to-br from-emerald-50 via-white to-cyan-50'
                                    : 'border-slate-200 bg-white/95' }}"
                        >


                            <!-- Header -->

                            <div class="flex items-start justify-between gap-4">

                                <div class="min-w-0">

                                    <h3 class="text-2xl font-bold text-slate-900 transition group-hover:text-cyan-600">
                                        {{ $deck->title }}
                                    </h3>

                                    <p class="mt-2 text-sm text-slate-500">
                                        by

                                        <span class="font-semibold text-slate-700">
                                            {{ $deck->user->name }}
                                        </span>
                                    </p>

                                </div>


                                <!-- Upvote -->

                                @auth

                                    @if ($deck->user_id !== Auth::id())

                                        <button
                                            type="button"
                                            wire:click="toggleUpvote({{ $deck->id }})"
                                            class="shrink-0 rounded-full px-4 py-2 text-sm font-medium transition
                                                {{ $isLiked
                                                    ? 'bg-amber-100 text-amber-700 ring-1 ring-amber-200'
                                                    : 'bg-white text-slate-600 shadow-sm ring-1 ring-slate-200 hover:bg-amber-50 hover:text-amber-700' }}"
                                            title="{{ $isLiked ? 'Remove upvote' : 'Upvote this deck' }}"
                                        >
                                            👍
                                        </button>

                                    @else

                                        <div
                                            class="shrink-0 rounded-full bg-white/80 px-4 py-2 text-sm text-slate-400 ring-1 ring-slate-200"
                                            title="You cannot upvote your own deck."
                                        >
                                            👍
                                        </div>

                                    @endif

                                @else

                                    <div
                                        class="shrink-0 rounded-full bg-white/80 px-4 py-2 text-sm text-slate-500 ring-1 ring-slate-200"
                                        title="Log in to upvote decks."
                                    >
                                        👍
                                    </div>

                                @endauth

                            </div>


                            <!-- Description -->

                            <p class="mt-6 min-h-[84px] leading-7 text-slate-600">
                                {{ $deck->description ?: 'No description available.' }}
                            </p>


                            <!-- Statistics -->

<div class="mt-8 grid grid-cols-2 gap-4">

    <!-- Flashcards -->

    <div
        class="rounded-2xl border border-cyan-200 bg-cyan-50 p-5"
    >

        <p class="text-3xl font-bold text-cyan-600">
            {{ $deck->flashcards->count() }}
        </p>

        <p class="mt-2 text-sm text-slate-500">
            Flashcards
        </p>

    </div>


    <!-- Upvotes -->

    <div
        class="rounded-2xl border border-indigo-200 bg-indigo-50 p-5"
    >

        <p class="text-3xl font-bold text-indigo-600">
            {{ $deck->voters->count() }}
        </p>

        <p class="mt-2 text-sm text-slate-500">
            Upvotes
        </p>

    </div>

</div>


                            <!-- Tags & Date -->

                            <div class="mt-6 flex items-center justify-between gap-3">

                                <div class="flex flex-wrap items-center gap-2">

                                    <!-- Visibility -->

                                    <span
                                        class="rounded-full px-4 py-2 text-sm font-medium
                                            {{ $isCompleted
                                                ? 'bg-white/80 text-slate-600 ring-1 ring-emerald-200'
                                                : 'bg-slate-100 text-slate-600' }}"
                                    >
                                        🌎 {{ ucfirst($deck->visibility) }}
                                    </span>


                                    <!-- Completed -->

@if ($isCompleted)

    <span class="rounded-full bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-sm">
        ✓ Completed
    </span>

@endif

                                </div>


                                <!-- Created -->

                                <span class="shrink-0 text-sm text-slate-400">
                                    {{ $deck->created_at->diffForHumans() }}
                                </span>

                            </div>


                            <!-- View Deck -->

                            <div class="mt-8">

                                <flux:button
                                    as="a"
                                    href="{{ route('view-deck', ['deck' => $deck]) }}"
                                    variant="primary"
                                    class="w-full justify-center"
                                    wire:navigate
                                >
                                    View Deck →
                                </flux:button>

                            </div>

                        </article>

                    @endforeach

                </div>

            @endif

        </div>

    </div>

</section>