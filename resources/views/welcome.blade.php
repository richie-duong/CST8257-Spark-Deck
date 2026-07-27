<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Spark Deck') }}</title>

        @fluxAppearance

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-900">
        <div class="min-h-screen">
            <header class="border-b border-slate-200 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 flex items-center justify-between gap-4">
                    <p class="text-lg font-semibold tracking-tight">Spark Deck</p>

                    @if (Route::has('login'))
                        <livewire:welcome.navigation />
                    @endif
                </div>
            </header>

            <main>
                <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-24">
                    <div class="max-w-3xl">
                        <p class="text-sm font-medium uppercase tracking-[0.18em] text-slate-500">Flashcard Learning Platform</p>
                        <h1 class="mt-4 text-4xl sm:text-5xl lg:text-6xl font-semibold leading-tight text-slate-900">
                            Study Smarter with Spark Deck
                        </h1>
                        <p class="mt-6 text-base sm:text-lg text-slate-600 max-w-2xl">
                            Spark Deck helps learners create and organize decks, study one card at a time, and discover community resources for faster, more focused revision.
                        </p>

                        <!-- TODO: Point this to onboarding flow when account setup journey is finalized. -->
                        <div class="mt-10 flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                            <flux:button as="a" href="{{ route('register') }}" variant="primary" class="justify-center sm:justify-start">
                                Get Started
                            </flux:button>

                            <!-- TODO: Replace with advanced discovery experience once filtering is implemented. -->
                            <flux:button as="a" href="{{ route('decks.browse') }}" variant="ghost" class="justify-center sm:justify-start">
                                Browse Decks
                            </flux:button>
                        </div>
                    </div>
                </section>

                <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20 sm:pb-24">
                    <header class="max-w-2xl">
                        <h2 class="text-2xl sm:text-3xl font-semibold text-slate-900">Features</h2>
                        <p class="mt-3 text-slate-600">Core tools to support building decks, exploring public content, and consistent study habits.</p>
                    </header>

                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 sm:gap-6">
                        <article class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                            <h3 class="text-lg font-semibold text-slate-900">Create & Organize Decks</h3>
                            <p class="mt-3 text-sm leading-6 text-slate-600">
                                Build topic-based decks, structure your flashcards clearly, and keep study material easy to manage.
                            </p>
                            <!-- TODO: Surface real deck counts and recent edits for the authenticated user. -->
                        </article>

                        <article class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                            <h3 class="text-lg font-semibold text-slate-900">Browse Community Decks</h3>
                            <p class="mt-3 text-sm leading-6 text-slate-600">
                                Explore public decks from other learners, find relevant topics quickly, and reuse high-quality study sets.
                            </p>
                            <!-- TODO: Connect to deck popularity signals and upvote interactions. -->
                        </article>

                        <article class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 md:col-span-2 xl:col-span-1">
                            <h3 class="text-lg font-semibold text-slate-900">Study Efficiently</h3>
                            <p class="mt-3 text-sm leading-6 text-slate-600">
                                Review flashcards one by one, stay focused during sessions, and track completion over time.
                            </p>
                            <!-- TODO: Add personalized study progress summaries and session resume state. -->
                        </article>
                    </div>
                </section>

                <section class="bg-white border-y border-slate-200">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
                        <header class="max-w-2xl">
                            <h2 class="text-2xl sm:text-3xl font-semibold text-slate-900">How It Works</h2>
                            <p class="mt-3 text-slate-600">Get started in three simple steps.</p>
                        </header>

                        <ol class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6 list-none">
                            <li class="rounded-2xl bg-slate-50 p-6 ring-1 ring-slate-200">
                                <p class="text-sm font-medium text-slate-500">1</p>
                                <p class="mt-2 text-base font-semibold text-slate-900">Create a deck</p>
                            </li>
                            <li class="rounded-2xl bg-slate-50 p-6 ring-1 ring-slate-200">
                                <p class="text-sm font-medium text-slate-500">2</p>
                                <p class="mt-2 text-base font-semibold text-slate-900">Add flashcards</p>
                            </li>
                            <li class="rounded-2xl bg-slate-50 p-6 ring-1 ring-slate-200">
                                <p class="text-sm font-medium text-slate-500">3</p>
                                <p class="mt-2 text-base font-semibold text-slate-900">Start studying</p>
                            </li>
                        </ol>
                        <!-- TODO: Link each step to guided product tours once onboarding is added. -->
                    </div>
                </section>

                <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-24 text-center">
                    <h2 class="text-3xl sm:text-4xl font-semibold text-slate-900">Ready to build your study system?</h2>
                    <p class="mt-4 text-slate-600 max-w-2xl mx-auto">
                        Create an account to start building decks, collaborating with the community, and improving your retention.
                    </p>

                    <!-- TODO: Attach analytics and conversion events to this call to action. -->
                    <div class="mt-8 flex justify-center">
                        <flux:button as="a" href="{{ route('register') }}" variant="primary">
                            Create Free Account
                        </flux:button>
                    </div>
                </section>
            </main>
        </div>

        @fluxScripts
    </body>
</html>
