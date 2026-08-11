<?php

use App\Models\Deck;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public Deck $deck;

    public bool $isCompleted = false;

    public function mount(Deck $deck): void
    {
        $this->deck = $deck;

        if (Auth::check()) {
            $this->isCompleted = $deck->completedBy()
                ->where('user_id', Auth::id())
                ->exists();
        }
    }
};

?>

<section class="relative overflow-hidden bg-gradient-to-br from-cyan-50 via-white to-indigo-50">

    <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="absolute -top-24 -right-24 h-72 w-72 rounded-full bg-cyan-100/40 blur-3xl"></div>
        <div class="absolute top-1/3 -left-32 h-80 w-80 rounded-full bg-indigo-100/30 blur-3xl"></div>
    </div>

    <div class="relative mx-auto max-w-5xl px-4 py-12 sm:px-6 lg:px-8">

        <!-- Back Link -->

        <a
            href="{{ route('browse-decks') }}"
            wire:navigate
            class="inline-flex items-center text-sm font-semibold text-indigo-600 transition hover:text-indigo-800"
        >
            ← Browse Decks
        </a>


        <!-- Header -->

        <div class="mt-8">

            <span class="inline-flex rounded-full bg-cyan-100 px-4 py-2 text-sm font-semibold text-cyan-700">
                📚 View Deck
            </span>

            <h1 class="mt-5 text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">
                {{ $deck->title }}
            </h1>

            @if ($deck->description)
                <p class="mt-4 max-w-3xl text-lg leading-8 text-slate-600">
                    {{ $deck->description }}
                </p>
            @endif

        </div>


        <!-- Study Callout -->

        <div class="mt-10 rounded-3xl border border-cyan-200 bg-gradient-to-r from-cyan-50 to-indigo-50 p-7 shadow-sm">

            <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <p class="text-sm font-semibold text-cyan-700">
                        Ready to Study?
                    </p>

                    <h2 class="mt-2 text-2xl font-bold text-slate-900">
                        Review this deck one card at a time.
                    </h2>

                    <p class="mt-2 max-w-2xl leading-7 text-slate-600">
                        Launch Study Mode for a focused flashcard session and mark the deck as complete when you're finished.
                    </p>

                </div>

                <flux:button
                    as="a"
                    href="{{ route('decks.study', $deck) }}"
                    class="w-full sm:w-auto justify-center !bg-indigo-600 !text-white hover:!bg-indigo-700"
                    wire:navigate
                >
                    Study Mode
                </flux:button>

            </div>

        </div>


        <!-- Deck Information -->

        <div class="mt-10 overflow-hidden rounded-3xl border border-slate-200 bg-white/90 shadow-lg">

            <div class="grid grid-cols-1 divide-y divide-slate-200 sm:grid-cols-2 sm:divide-x sm:divide-y-0 lg:grid-cols-4">

                <!-- Creator -->

                <div class="p-6">

                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">
                        Creator
                    </p>

                    <p class="mt-3 text-lg font-semibold text-slate-900">
                        {{ $deck->user->name }}
                    </p>

                </div>


                <!-- Flashcards -->

                <div class="p-6">

                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">
                        Flashcards
                    </p>

                    <p class="mt-3 text-3xl font-bold text-indigo-600">
                        {{ $deck->flashcards->count() }}
                    </p>

                </div>


                <!-- Visibility -->

                <div class="p-6">

                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">
                        Visibility
                    </p>

                    <span class="mt-3 inline-flex rounded-full bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700">
                        {{ ucfirst($deck->visibility) }}
                    </span>

                </div>


                <!-- Completion Status -->

                <div class="p-6">

                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">
                        Status
                    </p>

                    @auth

                        @if ($isCompleted)

                            <span class="mt-3 inline-flex items-center gap-2 rounded-full bg-emerald-100 px-4 py-2 text-sm font-semibold text-emerald-700">
                                ✓ Completed
                            </span>

                        @else

                            <span class="mt-3 inline-flex items-center rounded-full bg-slate-100 px-4 py-2 text-sm font-medium text-slate-600">
                                Not Completed
                            </span>

                        @endif

                    @else

                        <span class="mt-3 inline-flex items-center rounded-full bg-slate-100 px-4 py-2 text-sm font-medium text-slate-600">
                            Log in to track
                        </span>

                    @endauth

                </div>

            </div>

        </div>


        <!-- Created Date -->

        <div class="mt-4 flex items-center justify-end text-sm text-slate-500">

            <span>
                Created {{ $deck->created_at->format('M d, Y') }}
            </span>

        </div>


        <!-- Flashcards -->

        <div class="mt-12">

            <div class="flex items-end justify-between gap-4">

                <div>

                    <h2 class="text-3xl font-bold tracking-tight text-slate-900">
                        Flashcards
                    </h2>

                    <p class="mt-2 text-slate-600">
                        Review each flashcard below.
                    </p>

                </div>

                <span class="hidden rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-indigo-600 shadow-sm sm:inline-flex">
                    {{ $deck->flashcards->count() }}
                    {{ $deck->flashcards->count() === 1 ? 'Card' : 'Cards' }}
                </span>

            </div>


            <!-- Flashcard List -->

            <div class="mt-6 space-y-5">

                @forelse($deck->flashcards as $index => $flashcard)

                    <article class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

                        <!-- Card Header -->

                        <div class="flex items-center justify-between border-b border-slate-200 px-6 py-5">

                            <h3 class="text-lg font-bold text-slate-900">
                                Flashcard #{{ $index + 1 }}
                            </h3>

                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-500">
                                {{ $index + 1 }} / {{ $deck->flashcards->count() }}
                            </span>

                        </div>


                        <!-- Question -->

                        <div class="p-6 sm:p-8">

                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">
                                Question
                            </p>

                            <p class="mt-3 text-lg leading-7 text-slate-800">
                                {{ $flashcard->question }}
                            </p>


                            <!-- Answer -->

                            <div class="mt-7 rounded-2xl bg-emerald-50 p-5">

                                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-emerald-700">
                                    Answer
                                </p>

                                <p class="mt-3 text-lg font-semibold leading-7 text-emerald-800">
                                    {{ $flashcard->answer }}
                                </p>

                            </div>

                        </div>

                    </article>

                @empty

                    <div class="rounded-3xl border border-slate-200 bg-white p-10 text-center shadow-sm">

                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-slate-100 text-xl">
                            📚
                        </div>

                        <h3 class="mt-5 text-xl font-bold text-slate-900">
                            No flashcards yet
                        </h3>

                        <p class="mt-2 text-slate-600">
                            This deck doesn't have any flashcards to review.
                        </p>

                    </div>

                @endforelse

            </div>

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