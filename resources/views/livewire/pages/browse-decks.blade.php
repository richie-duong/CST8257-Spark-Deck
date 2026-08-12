<?php

use App\Models\Deck;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public string $search = '';

    public string $sort = 'newest';

    public array $filters = [];

    public function getDecksProperty()
    {
        return Deck::query()
            ->where('visibility', 'public')
            ->has('flashcards')

            // Search
            ->when(trim($this->search) !== '', function ($query) {
                $search = trim($this->search);

                $query->where(function ($query) use ($search) {
                    $query
                        ->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })

            // Sort
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

            // My Decks
            ->when(
                in_array('mine', $this->filters) && Auth::check(),
                function ($query) {
                    $query->where('user_id', Auth::id());
                }
            )

            // Liked
            ->when(
                in_array('liked', $this->filters) && Auth::check(),
                function ($query) {
                    $query->whereHas('voters', function ($query) {
                        $query->where('users.id', Auth::id());
                    });
                }
            )

            // Completed
            ->when(
                in_array('completed', $this->filters) && Auth::check(),
                function ($query) {
                    $query->whereHas('completedBy', function ($query) {
                        $query->where('users.id', Auth::id());
                    });
                }
            )

            // Relationships
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

        $alreadyVoted = $deck
            ->voters()
            ->where('user_id', Auth::id())
            ->exists();

        if ($alreadyVoted) {
            $deck->voters()->detach(Auth::id());
        } else {
            $deck->voters()->attach(Auth::id());
        }

        unset($this->decks);
    }

    public function toggleFilter(string $filter): void
    {
        if (in_array($filter, $this->filters)) {
            $this->filters = array_values(
                array_diff($this->filters, [$filter])
            );
        } else {
            $this->filters[] = $filter;
        }
    }

    public function resetFilters(): void
    {
        $this->search = '';
        $this->sort = 'newest';
        $this->filters = [];
    }
};

?>

<section class="relative min-h-screen overflow-hidden bg-gradient-to-br from-cyan-50 via-white to-indigo-50 py-16 sm:py-20">

    <!-- Decorative Background -->

    <div class="pointer-events-none absolute inset-0 overflow-hidden">

        <div
            class="absolute -left-32 top-20 h-96 w-96 rounded-full bg-cyan-200/40 blur-3xl"
        ></div>

        <div
            class="absolute -right-32 top-0 h-[500px] w-[500px] rounded-full bg-indigo-200/40 blur-3xl"
        ></div>

        <div
            class="absolute bottom-[-200px] left-1/3 h-[450px] w-[450px] rounded-full bg-cyan-100/40 blur-3xl"
        ></div>

    </div>


    <!-- Main Content -->

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">


        <!-- Hero -->

        <div class="max-w-3xl">

            <span
                class="inline-flex items-center rounded-full bg-cyan-100 px-4 py-2 text-sm font-semibold text-cyan-700"
            >
                🌎 Community Library
            </span>

            <h1 class="mt-6 text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">
                Browse Community Decks
            </h1>

            <p class="mt-5 max-w-2xl text-lg leading-8 text-slate-600">
                Discover flashcard decks created by learners around the world.
                Search study materials, explore popular topics, and prepare
                smarter with Spark Deck.
            </p>

        </div>


        <!-- Search & Controls -->

        <div
            class="mt-10 rounded-3xl border border-slate-200 bg-white/90 p-6 shadow-xl backdrop-blur sm:p-8"
        >

            @guest

                <!-- Guest Call to Action -->

                <div class="mb-7 flex flex-col gap-4 rounded-2xl border border-cyan-200 bg-gradient-to-r from-cyan-50 to-indigo-50 p-5 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-start gap-4">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-white text-xl shadow-sm">
                            ✨
                        </div>

                        <div>

                            <h2 class="font-bold text-slate-900">
                                Want to contribute to the community?
                            </h2>

                            <p class="mt-1 text-sm leading-6 text-slate-600">
                                Guests can browse and study public decks with limited features.
                                Register to create decks, upvote useful content, and track your progress.
                            </p>

                        </div>

                    </div>

                    <a
                        href="{{ route('register') }}"
                        wire:navigate
                        class="inline-flex shrink-0 items-center justify-center rounded-full bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-indigo-700 hover:shadow-md"
                    >
                        Create an Account
                    </a>

                </div>

            @endguest


            <!-- Search -->

            <div>

                <label
                    for="search"
                    class="block text-sm font-semibold text-slate-700"
                >
                    Search Public Decks
                </label>

                <div class="relative mt-3">

                    <input
                        id="search"
                        type="search"
                        wire:model.live.debounce.300ms="search"
                        placeholder="Search by title or description..."
                        class="block w-full rounded-2xl border border-slate-200 bg-white px-5 py-4 text-base text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-cyan-400 focus:ring-4 focus:ring-cyan-100"
                    >

                    @if ($search !== '')

                        <button
                            type="button"
                            wire:click="$set('search', '')"
                            class="absolute right-4 top-1/2 -translate-y-1/2 rounded-full px-2 py-1 text-sm font-semibold text-slate-400 transition hover:bg-slate-100 hover:text-slate-600"
                            aria-label="Clear search"
                        >
                            ✕
                        </button>

                    @endif

                </div>

            </div>


            <!-- Sort & Filter -->

            <div class="mt-7 flex flex-col gap-5 border-t border-slate-200 pt-6 lg:flex-row lg:items-center lg:justify-between">

                <!-- Sort -->

                <div class="flex flex-wrap items-center gap-2">

                    <span class="mr-1 text-sm font-semibold text-slate-700">
                        Sort By:
                    </span>

                    <button
                        type="button"
                        wire:click="$set('sort', 'newest')"
                        class="
                            rounded-full px-4 py-2 text-sm font-semibold transition
                            {{
                                $sort === 'newest'
                                    ? 'bg-gradient-to-r from-cyan-500 to-indigo-600 text-white shadow-sm'
                                    : 'bg-white text-slate-600 ring-1 ring-slate-200 hover:bg-cyan-50 hover:text-cyan-700'
                            }}
                        "
                    >
                        🕒 Newest
                    </button>

                    <button
                        type="button"
                        wire:click="$set('sort', 'popular')"
                        class="
                            rounded-full px-4 py-2 text-sm font-semibold transition
                            {{
                                $sort === 'popular'
                                    ? 'bg-gradient-to-r from-cyan-500 to-indigo-600 text-white shadow-sm'
                                    : 'bg-white text-slate-600 ring-1 ring-slate-200 hover:bg-cyan-50 hover:text-cyan-700'
                            }}
                        "
                    >
                        🔥 Most Popular
                    </button>

                    <button
                        type="button"
                        wire:click="$set('sort', 'oldest')"
                        class="
                            rounded-full px-4 py-2 text-sm font-semibold transition
                            {{
                                $sort === 'oldest'
                                    ? 'bg-gradient-to-r from-cyan-500 to-indigo-600 text-white shadow-sm'
                                    : 'bg-white text-slate-600 ring-1 ring-slate-200 hover:bg-cyan-50 hover:text-cyan-700'
                            }}
                        "
                    >
                        📅 Oldest
                    </button>

                </div>


                <!-- Filter -->

                <div class="flex flex-wrap items-center gap-2">

                    @auth

                        <span class="mr-1 text-sm font-semibold text-slate-700">
                            Filter By:
                        </span>

                        <button
                            type="button"
                            wire:click="toggleFilter('mine')"
                            class="
                                rounded-full px-4 py-2 text-sm font-semibold transition
                                {{
                                    in_array('mine', $filters)
                                        ? 'bg-gradient-to-r from-cyan-500 to-indigo-600 text-white shadow-sm'
                                        : 'bg-white text-slate-600 ring-1 ring-slate-200 hover:bg-cyan-50 hover:text-cyan-700'
                                }}
                            "
                        >
                            ✨ My Decks
                        </button>

                        <button
                            type="button"
                            wire:click="toggleFilter('liked')"
                            class="
                                rounded-full px-4 py-2 text-sm font-semibold transition
                                {{
                                    in_array('liked', $filters)
                                        ? 'bg-gradient-to-r from-cyan-500 to-indigo-600 text-white shadow-sm'
                                        : 'bg-white text-slate-600 ring-1 ring-slate-200 hover:bg-cyan-50 hover:text-cyan-700'
                                }}
                            "
                        >
                            👍 Liked
                        </button>

                        <button
                            type="button"
                            wire:click="toggleFilter('completed')"
                            class="
                                rounded-full px-4 py-2 text-sm font-semibold transition
                                {{
                                    in_array('completed', $filters)
                                        ? 'bg-gradient-to-r from-cyan-500 to-indigo-600 text-white shadow-sm'
                                        : 'bg-white text-slate-600 ring-1 ring-slate-200 hover:bg-cyan-50 hover:text-cyan-700'
                                }}
                            "
                        >
                            ✓ Completed
                        </button>

                    @endauth


                    <!-- Reset -->

                    <button
                        type="button"
                        wire:click="resetFilters"
                        class="rounded-full px-4 py-2 text-sm font-semibold text-slate-500 transition hover:bg-slate-100 hover:text-slate-700"
                    >
                        ↻ Reset
                    </button>

                </div>

            </div>

        </div>


        <!-- Results -->

        <div class="mt-12">

            @if ($this->decks->isEmpty())

                <!-- Empty State -->

                <div
                    class="rounded-3xl border border-slate-200 bg-white/90 p-12 text-center shadow-xl"
                >

                    <div
                        class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-cyan-100 text-4xl"
                    >
                        📚
                    </div>

                    <h3 class="mt-7 text-2xl font-bold text-slate-900">
                        No Decks Found
                    </h3>

                    <p class="mx-auto mt-3 max-w-lg text-base leading-7 text-slate-600">
                        We couldn't find any public decks matching your search.
                        Try another keyword, filter, or browse the newest community decks.
                    </p>

                    <div class="mt-6 flex justify-center">

                        <button
                            type="button"
                            wire:click="resetFilters"
                            class="rounded-full bg-gradient-to-r from-cyan-500 to-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg"
                        >
                            Reset Filters
                        </button>

                    </div>

                </div>

            @else

                            <!-- Results Header -->

                <div class="mb-6 flex items-end justify-between">

                    <div>

                        <h2 class="text-2xl font-bold text-slate-900">
                            Public Decks
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            {{ $this->decks->count() }}
                            {{ $this->decks->count() === 1 ? 'deck' : 'decks' }}
                            found
                        </p>

                    </div>

                </div>


                <!-- Deck Grid -->

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

                    @foreach ($this->decks as $deck)

                        @php

                            $isLiked = Auth::check()
                                && $deck->voters->contains('id', Auth::id());

                            $isCompleted = Auth::check()
                                && $deck->completedBy->contains('id', Auth::id());

                            $isOwner = Auth::check()
                                && $deck->user_id === Auth::id();

                        @endphp


                        <!-- Deck Card -->

                        <article
                            wire:key="deck-{{ $deck->id }}"
                            class="
                                group
                                flex
                                flex-col
                                rounded-3xl
                                border
                                p-7
                                shadow-sm
                                transition
                                duration-300
                                hover:-translate-y-1
                                hover:shadow-xl

                                {{
                                    $isCompleted
                                        ? 'border-emerald-200 bg-gradient-to-br from-emerald-50 via-white to-cyan-50'
                                        : (
                                            $isOwner
                                                ? 'border-cyan-300 bg-cyan-100'
                                                : 'border-slate-200 bg-white/95'
                                        )
                                }}
                            "
                        >

                            <!-- Header -->

                            <div class="flex items-start justify-between gap-4">

                                <div class="min-w-0">

                                    <h3
                                        class="break-words text-2xl font-bold text-slate-900 transition group-hover:text-cyan-600"
                                    >
                                        {{ $deck->title }}
                                    </h3>

                                    <div class="mt-2 flex flex-wrap items-center gap-2">

                                        <p class="text-sm text-slate-500">
                                            by

                                            <span class="font-semibold text-slate-700">
                                                {{ $deck->user->name }}
                                            </span>
                                        </p>

                                        @if ($isOwner)

                                            <span
                                                class="inline-flex items-center rounded-full bg-cyan-600 px-3 py-1 text-xs font-semibold text-white shadow-sm"
                                            >
                                                ✨ Your Deck
                                            </span>

                                        @endif

                                    </div>

                                </div>


                                <!-- Upvote -->

                                @auth

                                    <button
                                        type="button"
                                        wire:click="toggleUpvote({{ $deck->id }})"
                                        class="
                                            shrink-0
                                            rounded-full
                                            px-4
                                            py-2
                                            text-sm
                                            font-medium
                                            transition

                                            {{
                                                $isLiked
                                                    ? 'bg-green-100 text-green-700 ring-1 ring-green-200 hover:bg-green-200'
                                                    : 'bg-white text-slate-600 shadow-sm ring-1 ring-slate-200 hover:bg-cyan-50 hover:text-cyan-700'
                                            }}
                                        "
                                        title="{{
                                            $isLiked
                                                ? 'Remove your upvote'
                                                : 'Upvote this deck'
                                        }}"
                                        aria-label="{{
                                            $isLiked
                                                ? 'Remove your upvote'
                                                : 'Upvote this deck'
                                        }}"
                                    >
                                        👍
                                    </button>

                                @endauth

                            </div>


                            <!-- Description -->

                            <p class="mt-6 min-h-[84px] break-words leading-7 text-slate-600">
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
                                        📚 Flashcards
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
                                        👍 Upvotes
                                    </p>

                                </div>

                            </div>


                            <!-- Bottom Information -->

                            <div class="mt-6 flex items-center justify-between gap-3">

                                <div class="flex flex-wrap items-center gap-2">

                                    <span
                                        class="
                                            rounded-full
                                            px-4
                                            py-2
                                            text-sm
                                            font-medium

                                            {{
                                                $isCompleted
                                                    ? 'bg-white/80 text-slate-600 ring-1 ring-emerald-200'
                                                    : 'bg-slate-100 text-slate-600'
                                            }}
                                        "
                                    >
                                        🌎 {{ ucfirst($deck->visibility) }}
                                    </span>

                                    @if ($isCompleted)

                                        <span
                                            class="rounded-full bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-sm"
                                        >
                                            ✓ Completed
                                        </span>

                                    @endif

                                </div>


                                <span class="shrink-0 text-sm text-slate-400">
                                    {{ $deck->created_at->diffForHumans() }}
                                </span>

                            </div>


                            <!-- View Deck -->

                            <div class="mt-8">

                                <a
                                    href="{{ route('view-deck', ['deck' => $deck]) }}"
                                    wire:navigate
                                    class="flex w-full items-center justify-center rounded-full bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-indigo-700 hover:shadow-lg"
                                >
                                    View Deck →
                                </a>

                            </div>

                        </article>

                    @endforeach

                </div>

            @endif

        </div>

    </div>


    <!-- Back to Top Button -->
    <button
        x-data="{ show: false }"
        x-show="show"
        x-transition
        @scroll.window="show = window.scrollY > 300"
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="fixed bottom-6 right-6 z-50 flex h-12 w-12 items-center justify-center rounded-full bg-indigo-600 text-white shadow-lg transition hover:-translate-y-1 hover:bg-indigo-700 hover:shadow-xl"
        aria-label="Back to top"
    >
        ↑
    </button>

</section>