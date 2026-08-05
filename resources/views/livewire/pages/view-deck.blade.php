<?php

use App\Models\Deck;
use Livewire\Volt\Component;

new class extends Component
{
    public Deck $deck;
};

?>

<section class="relative overflow-hidden bg-gradient-to-br from-cyan-50 via-white to-indigo-50 py-20">

    <!-- Decorative Background -->

    <div class="absolute -left-20 top-0 h-96 w-96 rounded-full bg-cyan-200/30 blur-3xl"></div>

    <div class="absolute right-0 top-0 h-[420px] w-[420px] rounded-full bg-indigo-200/30 blur-3xl"></div>

    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Hero -->

        <div class="max-w-3xl">

            <span class="inline-flex items-center rounded-full bg-cyan-100 px-4 py-2 text-sm font-semibold text-cyan-700">

                📚 Study Deck

            </span>

            <h1 class="mt-6 text-5xl font-bold tracking-tight text-slate-900">

                {{ $deck->title }}

            </h1>

            <p class="mt-6 text-lg leading-8 text-slate-600">

                {{ $deck->description }}

            </p>

        </div>

        <!-- Deck Information -->

        <!-- Study CTA -->

<div class="mt-10 rounded-3xl border border-indigo-100 bg-gradient-to-r from-cyan-50 to-indigo-50 p-8 shadow-sm">

    <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">

        <div>

            <h2 class="text-2xl font-bold text-slate-900">

                Ready to Study?

            </h2>

            <p class="mt-2 text-slate-600">

                Launch Study Mode to review these flashcards one at a time with a distraction-free experience.

            </p>

        </div>

        <flux:button
            disabled
            variant="primary"
            class="justify-center md:w-auto"
        >
            🎓 Study Deck
            <span class="ml-2 text-xs opacity-75">
                (Coming Soon)
            </span>
        </flux:button>

    </div>

</div>

        <div class="mt-12 rounded-3xl border border-slate-200 bg-white shadow-xl">

            <div class="grid grid-cols-2 divide-x divide-y divide-slate-200 lg:grid-cols-4 lg:divide-y-0">

                <div class="p-6">

                    <p class="text-xs font-semibold uppercase tracking-widest text-slate-500">

                        Creator

                    </p>

                    <p class="mt-3 text-lg font-semibold text-slate-900">

                        {{ $deck->user->name }}

                    </p>

                </div>

                <div class="p-6">

                    <p class="text-xs font-semibold uppercase tracking-widest text-slate-500">

                        Flashcards

                    </p>

                    <p class="mt-3 text-3xl font-bold text-indigo-600">

                        {{ $deck->flashcards->count() }}

                    </p>

                </div>

                <div class="p-6">

                    <p class="text-xs font-semibold uppercase tracking-widest text-slate-500">

                        Visibility

                    </p>

                    <span class="mt-3 inline-flex rounded-full bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700">

                        {{ ucfirst($deck->visibility) }}

                    </span>

                </div>

                <div class="p-6">

                    <p class="text-xs font-semibold uppercase tracking-widest text-slate-500">

                        Created

                    </p>

                    <p class="mt-3 font-semibold text-slate-900">

                        {{ $deck->created_at->format('M d, Y') }}

                    </p>

                    <p class="text-sm text-slate-500">

                        {{ $deck->created_at->diffForHumans() }}

                    </p>

                </div>

            </div>

        </div>

        <!-- Flashcards -->

        <div class="mt-16">

            <div class="flex items-center justify-between">

                <div>

                    <h2 class="text-3xl font-bold text-slate-900">

                        Flashcards

                    </h2>

                    <p class="mt-2 text-slate-500">

                        Review each flashcard below.

                    </p>

                </div>

                <div class="rounded-full border border-slate-200 bg-white px-5 py-2 shadow-sm">

                    <span class="font-semibold text-indigo-600">

                        {{ $deck->flashcards->count() }}

                    </span>

                    <span class="text-slate-500">

                        Cards

                    </span>

                </div>

            </div>

            <div class="mt-8 space-y-8">

            @foreach ($deck->flashcards as $index => $flashcard)

    <article class="rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:shadow-lg">

        <!-- Card Header -->

        <div class="flex items-center justify-between border-b border-slate-200 px-8 py-5">

            <div>

                <h3 class="text-xl font-semibold text-slate-900">

                    Flashcard #{{ $index + 1 }}

                </h3>

            </div>

            <span class="rounded-full bg-slate-100 px-4 py-2 text-sm font-medium text-slate-600">

                {{ $index + 1 }} / {{ $deck->flashcards->count() }}

            </span>

        </div>

        <!-- Card Body -->

        <div class="p-8">

            <!-- Question -->

            <div>

                <h4 class="text-sm font-semibold uppercase tracking-wider text-slate-500">

                    Question

                </h4>

                <div class="mt-4 border-l-4 border-slate-300 pl-5">

                    <p class="text-xl leading-9 text-slate-800">

                        {{ $flashcard->question }}

                    </p>

                </div>

            </div>

            <!-- Divider -->

            <div class="my-8 border-t border-slate-200"></div>

            <!-- Answer -->

            <div>

                <h4 class="text-sm font-semibold uppercase tracking-wider text-emerald-700">

                    💡 Answer

                </h4>

                <div class="mt-4 rounded-2xl border border-emerald-200 bg-emerald-50 p-6">

                    <p class="text-lg leading-8 text-slate-700">

                        {{ $flashcard->answer }}

                    </p>

                </div>

            </div>

        </div>

    </article>

@endforeach

            </div>

        </div>

    </div>

</section>