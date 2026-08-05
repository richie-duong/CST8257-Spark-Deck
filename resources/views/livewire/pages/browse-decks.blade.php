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

            ->when($this->sort === 'newest', fn ($query) => $query->latest())
            ->when($this->sort === 'oldest', fn ($query) => $query->oldest())
            ->when($this->sort === 'popular', fn ($query) => $query->orderByDesc('voters_count'))

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

<section class="relative overflow-hidden bg-gradient-to-br from-cyan-50 via-white to-indigo-50 py-20">

    <!-- Decorative Background -->

    <div class="absolute -left-24 top-12 h-96 w-96 rounded-full bg-cyan-200/40 blur-3xl"></div>

    <div class="absolute right-0 top-0 h-[500px] w-[500px] rounded-full bg-indigo-200/40 blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

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

        <!-- Search Panel -->

        <div class="mt-12 rounded-3xl border border-slate-200 bg-white/90 backdrop-blur p-8 shadow-xl">

            <!-- Search -->

<div>

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

            <!-- Filter Pills -->

            <div class="mt-8 border-t border-slate-200 pt-8">

                <p class="text-sm font-semibold text-slate-700">

                    Sort By

                </p>
                

                <div class="mt-4 flex flex-wrap gap-3">

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

                </div>

            </div>

        </div>

        <!-- Section Header -->

        <div class="mt-16 flex items-center justify-between">

            <div>

                <h2 class="text-3xl font-bold text-slate-900">

                    Explore Decks

                </h2>

                <p class="mt-2 text-slate-500">

                    Browse the latest flashcard decks shared by the community.

                </p>

            </div>

            <div class="hidden md:block rounded-full bg-white px-6 py-3 shadow border border-slate-200">

                <span class="font-semibold text-indigo-600">

                    {{ $this->decks->count() }}

                </span>

                <span class="text-slate-500">

                    decks found

                </span>

            </div>

        </div>

        <div class="mt-10">

        @if ($this->decks->isEmpty())

<div class="rounded-3xl border border-slate-200 bg-white p-16 text-center shadow-lg">

    <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-cyan-100 text-5xl">

        📚

    </div>

    <h3 class="mt-8 text-3xl font-bold text-slate-900">

        No Decks Found

    </h3>

    <p class="mt-4 max-w-lg mx-auto text-lg text-slate-600">

        We couldn't find any public decks matching your search.
        Try another keyword or browse the newest community decks.

    </p>

</div>

@else

<div class="grid gap-8 md:grid-cols-2 xl:grid-cols-3">

@foreach ($this->decks as $deck)

<article
    class="group rounded-[28px] border border-slate-200 bg-white p-7 shadow-sm transition duration-300 hover:-translate-y-2 hover:shadow-2xl">

    <!-- Header -->

    <div class="flex items-start justify-between">

        <div>

            <h3 class="text-2xl font-bold text-slate-900 group-hover:text-cyan-600 transition">

                {{ $deck->title }}

            </h3>

            <p class="mt-2 text-sm text-slate-500">

                by

                <span class="font-semibold text-slate-700">

                    {{ $deck->user->name }}

                </span>

            </p>

        </div>

        @auth

            @if ($deck->user_id !== auth()->id())

                <button
                    wire:click="toggleUpvote({{ $deck->id }})"
                    class="rounded-full px-4 py-2 transition

                    {{ $deck->voters->contains(auth()->id())
                        ? 'bg-green-100 text-green-700'
                        : 'bg-slate-100 text-slate-600 hover:bg-cyan-100 hover:text-cyan-700' }}"
                >

                    👍

                </button>

            @else

                <div class="rounded-full bg-slate-100 px-4 py-2 text-slate-400">

                    👍 {{ $deck->voters->count() }}

                </div>

            @endif


        @endauth

    </div>

    <!-- Description -->

    <p class="mt-6 leading-7 text-slate-600 min-h-[84px]">

        {{ $deck->description ?: 'No description available.' }}

    </p>

    <!-- Stats -->

    <div class="mt-8 grid grid-cols-2 gap-4">

        <div class="rounded-2xl bg-cyan-50 p-5">

            <p class="text-3xl font-bold text-cyan-600">

                {{ $deck->flashcards->count() }}

            </p>

            <p class="mt-2 text-sm text-slate-500">

                Flashcards

            </p>

        </div>

        <div class="rounded-2xl bg-indigo-50 p-5">

            <p class="text-3xl font-bold text-indigo-600">

                {{ $deck->voters->count() }}

            </p>

            <p class="mt-2 text-sm text-slate-500">

                Upvotes

            </p>

        </div>

    </div>

    <!-- Visibility -->

    <div class="mt-6 flex items-center justify-between">

        <span class="rounded-full bg-slate-100 px-4 py-2 text-sm font-medium text-slate-600">

            🌎 {{ ucfirst($deck->visibility) }}

        </span>

        <span class="text-sm text-slate-400">

            {{ $deck->created_at->diffForHumans() }}

        </span>

    </div>

    <!-- Button -->

    <div class="mt-8">

        <flux:button
            as="a"
            href="{{ route('view-deck', $deck) }}"
            variant="primary"
            class="w-full justify-center"
        >

            View Deck →

        </flux:button>

    </div>

</article>

@endforeach

</div>

@endif

    </div>

</section>