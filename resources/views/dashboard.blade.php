<x-app-layout>
@php

    $user = auth()->user();

    $decks = $user->decks()
        ->withCount('voters')
        ->get();

    $myDecks = $decks->count();

    $completedDecks = $user->completedDecks()->count();

    $publicDecks = $decks
        ->where('visibility', 'public')
        ->count();

    $upvotesReceived = $decks->sum('voters_count');

@endphp


<section class="relative min-h-full overflow-hidden bg-gradient-to-br from-cyan-50 via-white to-indigo-50">


    <!-- Decorative background elements -->

    <div class="pointer-events-none absolute inset-0 overflow-hidden">

        <div class="absolute -top-24 -right-24 h-72 w-72 rounded-full bg-cyan-100/40 blur-3xl"></div>

        <div class="absolute top-1/3 -left-32 h-80 w-80 rounded-full bg-indigo-100/30 blur-3xl"></div>

    </div>


    <div class="relative mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-20 lg:px-8">


        <!-- Welcome Header -->

        <div class="max-w-3xl">

            <span class="inline-flex rounded-full bg-cyan-100 px-4 py-2 text-sm font-semibold text-cyan-700">
                Your Study Space
            </span>

            <h1 class="mt-6 text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">
    Welcome back,
    <span class="bg-gradient-to-r from-cyan-500 to-indigo-600 bg-clip-text text-transparent">
        {{ auth()->user()->name }}
    </span>
</h1>

            <p class="mt-5 text-lg leading-8 text-slate-600">
                Build your own flashcard decks, study at your pace, or discover material shared by the community.
            </p>

        </div>


        <!-- Statistics -->

        <div class="mt-10 grid grid-cols-2 gap-4 lg:grid-cols-4">


            <!-- My Decks -->

            <div class="rounded-3xl border border-slate-200 bg-white/90 p-6 shadow-sm">

                <div class="flex items-center justify-between gap-4">

                    <div>

                        <p class="text-sm font-semibold text-slate-500">
                            My Decks
                        </p>

                        <p class="mt-2 text-3xl font-bold text-slate-900">
                            {{ $myDecks }}
                        </p>

                    </div>

                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-cyan-100 text-lg">
                        📚
                    </div>

                </div>

                <p class="mt-3 text-sm text-slate-500">
                    Decks you've created
                </p>

            </div>


           <!-- Completed Decks -->

        <div class="rounded-3xl border border-slate-200 bg-white/90 p-6 shadow-sm">

            <div class="flex items-center justify-between gap-4">

                <div>

                    <p class="text-sm font-semibold text-slate-500">
                        Completed Decks
                    </p>

                    <p class="mt-2 text-3xl font-bold text-slate-900">
                        {{ $completedDecks }}
                    </p>

                </div>

                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-indigo-100 text-lg font-semibold text-indigo-600">
                    ✓
                </div>

            </div>

            <p class="mt-3 text-sm text-slate-500">
                Decks you've finished
            </p>

        </div>


            <!-- Public Decks -->

            <div class="rounded-3xl border border-slate-200 bg-white/90 p-6 shadow-sm">

                <div class="flex items-center justify-between gap-4">

                    <div>

                        <p class="text-sm font-semibold text-slate-500">
                            Public Decks
                        </p>

                        <p class="mt-2 text-3xl font-bold text-slate-900">
                            {{ $publicDecks }}
                        </p>

                    </div>

                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-cyan-100 text-lg">
                        🌎
                    </div>

                </div>

                <p class="mt-3 text-sm text-slate-500">
                    Decks shared with the community
                </p>

            </div>


            <!-- Upvotes Received -->

            <div class="rounded-3xl border border-slate-200 bg-white/90 p-6 shadow-sm">

                <div class="flex items-center justify-between gap-4">

                    <div>

                        <p class="text-sm font-semibold text-slate-500">
                            Upvotes Received
                        </p>

                        <p class="mt-2 text-3xl font-bold text-slate-900">
                            {{ $upvotesReceived }}
                        </p>

                    </div>

                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-green-100 text-lg">
                        👍
                    </div>

                </div>

                <p class="mt-3 text-sm text-slate-500">
                    Community appreciation
                </p>

            </div>

        </div>


        <!-- Main Navigation Cards -->

        <div class="mt-12 grid gap-6 md:grid-cols-3">


            <!-- My Decks -->

            <a
                href="{{ route('decks.index') }}"
                class="group rounded-3xl border border-slate-200 bg-white/90 p-7 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl"
                wire:navigate
            >

                <span class="text-sm font-semibold text-cyan-700">
                    Build
                </span>

                <h2 class="mt-3 text-2xl font-bold text-slate-900 group-hover:text-cyan-700">
                    My Decks
                </h2>

                <p class="mt-3 leading-7 text-slate-600">
                    Create decks, update their details, and manage the flashcards inside them.
                </p>

                <span class="mt-6 inline-flex font-semibold text-indigo-600">
                    Open my decks →
                </span>

            </a>


            <!-- Browse Decks -->

            <a
                href="{{ route('browse-decks') }}"
                class="group rounded-3xl border border-slate-200 bg-white/90 p-7 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl"
                wire:navigate
            >

                <span class="text-sm font-semibold text-cyan-700">
                    Discover
                </span>

                <h2 class="mt-3 text-2xl font-bold text-slate-900 group-hover:text-cyan-700">
                    Browse Decks
                </h2>

                <p class="mt-3 leading-7 text-slate-600">
                    Explore public decks from other learners and find something new to study.
                </p>

                <span class="mt-6 inline-flex font-semibold text-indigo-600">
                    Browse the library →
                </span>

            </a>


            <!-- Profile Settings -->

            <a
                href="{{ route('profile') }}"
                class="group rounded-3xl border border-slate-200 bg-white/90 p-7 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl"
                wire:navigate
            >

                <span class="text-sm font-semibold text-cyan-700">
                    Account
                </span>

                <h2 class="mt-3 text-2xl font-bold text-slate-900 group-hover:text-cyan-700">
                    Profile Settings
                </h2>

                <p class="mt-3 leading-7 text-slate-600">
                    Keep your profile details and account security information up to date.
                </p>

                <span class="mt-6 inline-flex font-semibold text-indigo-600">
                    Manage profile →
                </span>

            </a>

        </div>


        <!-- Study Callout -->

        <div class="mt-10 rounded-3xl border border-slate-200 bg-white/90 p-7 shadow-sm">

            <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <span class="text-sm font-semibold text-cyan-700">
                        Ready to study?
                    </span>

                    <h2 class="mt-2 text-2xl font-bold text-slate-900">
                        Find a deck and start learning.
                    </h2>

                    <p class="mt-2 max-w-2xl leading-7 text-slate-600">
                        Explore community-created decks and find study material that matches what you're learning.
                    </p>

                </div>

                <a
                    href="{{ route('browse-decks') }}"
                    wire:navigate
                    class="inline-flex shrink-0 items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700"
                >
                    Browse Decks →
                </a>

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
</x-app-layout>