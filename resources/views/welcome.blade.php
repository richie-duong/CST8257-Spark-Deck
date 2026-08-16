<x-app-layout>
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Spark Deck</title>

        @fluxAppearance

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased bg-white text-slate-900">

    <div class="min-h-screen">

        <!-- Navigation -->

        <main>

            <!-- HERO -->

            <section class="relative overflow-hidden">

                <!-- Background -->

                <div class="absolute inset-0 bg-gradient-to-br from-cyan-50 via-white to-indigo-50"></div>

                <div class="absolute -left-20 top-20 h-96 w-96 rounded-full bg-cyan-200 blur-3xl opacity-40"></div>

                <div class="absolute right-0 top-0 h-[500px] w-[500px] rounded-full bg-indigo-200 blur-3xl opacity-40"></div>

                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">

                    <div class="grid lg:grid-cols-2 gap-20 items-center">

                        <!-- Left Side -->

                        <div>

                            <span class="inline-flex items-center rounded-full bg-cyan-100 px-4 py-2 text-sm font-medium text-cyan-700">

                                📚 Study Smarter

                            </span>

                            <h1 class="mt-8 text-5xl lg:text-7xl font-bold tracking-tight leading-tight text-slate-900">

                                Your Study

                                <span class="bg-gradient-to-r from-cyan-500 to-indigo-600 bg-clip-text text-transparent">
                                    Superpower.
                                </span>

                            </h1>

                            <p class="mt-8 max-w-xl text-lg leading-8 text-slate-600">

                                Create flashcard decks, browse community resources,
                                and study more efficiently with a modern learning platform
                                designed to help you retain knowledge faster.

                            </p>

                            <!-- Hero Buttons -->

                            <div class="mt-10 flex flex-col sm:flex-row gap-4">

                                <a
                                    href="{{ route('register') }}"
                                    wire:navigate
                                    class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-cyan-500 to-indigo-600 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-indigo-200/50 transition duration-300 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-indigo-200/70 focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:ring-offset-2"
                                >
                                    Get Started
                                </a>

                                <a
                                    href="{{ route('browse-decks') }}"
                                    wire:navigate
                                    class="inline-flex items-center justify-center rounded-xl border-2 border-indigo-200 bg-white px-6 py-3.5 text-sm font-bold text-indigo-700 shadow-md transition duration-300 hover:-translate-y-0.5 hover:border-indigo-300 hover:bg-indigo-50 hover:text-indigo-800 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:ring-offset-2"
                                >
                                    Browse Decks
                                </a>

                            </div>

                            <div class="mt-12 flex gap-10">

                                <div>

                                    <p class="text-3xl font-bold text-indigo-600">
                                        100%
                                    </p>

                                    <p class="text-slate-500">
                                        Free
                                    </p>

                                </div>

                                <div>

                                    <p class="text-3xl font-bold text-indigo-600">
                                        Public
                                    </p>

                                    <p class="text-slate-500">
                                        Community Decks
                                    </p>

                                </div>

                                <div>

                                    <p class="text-3xl font-bold text-indigo-600">
                                        Fast
                                    </p>

                                    <p class="text-slate-500">
                                        Study Sessions
                                    </p>

                                </div>

                            </div>

                        </div>

                        <!-- Right Side -->

                        <div class="relative">

                            <div class="absolute inset-0 rounded-[40px] bg-gradient-to-r from-cyan-300/40 to-indigo-300/40 blur-3xl"></div>

                            <div class="relative rounded-[32px] border border-slate-200 bg-white p-8 shadow-2xl">

                                <!-- Flashcard -->

                                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-7">

                                    <div class="flex justify-between items-center">

                                        <span class="rounded-full bg-cyan-100 px-3 py-1 text-xs font-semibold text-cyan-700">
                                            Biology Midterm
                                        </span>

                                        <span class="text-slate-400">
                                            ⭐ Popular
                                        </span>

                                    </div>

                                    <h2 class="mt-8 text-2xl font-bold text-slate-900">

                                        What organelle is known as the powerhouse of the cell?

                                    </h2>

                                    <div class="mt-8 rounded-xl border border-slate-200 bg-white p-5">

                                        <p class="text-slate-600">

                                            💡 The mitochondrion produces ATP through
                                            cellular respiration, supplying energy for
                                            the cell.

                                        </p>

                                    </div>

                                </div>

                                <!-- Quick Stats -->

                                <div class="mt-6 grid grid-cols-3 gap-4">

                                    <div class="rounded-xl bg-cyan-50 border border-cyan-100 p-4 text-center">

                                        <p class="text-2xl font-bold text-cyan-600">
                                            150+
                                        </p>

                                        <p class="mt-1 text-sm text-slate-500">
                                            Decks
                                        </p>

                                    </div>

                                    <div class="rounded-xl bg-indigo-50 border border-indigo-100 p-4 text-center">

                                        <p class="text-2xl font-bold text-indigo-600">
                                            2.4K
                                        </p>

                                        <p class="mt-1 text-sm text-slate-500">
                                            Upvotes
                                        </p>

                                    </div>

                                    <div class="rounded-xl bg-sky-50 border border-sky-100 p-4 text-center">

                                        <p class="text-2xl font-bold text-sky-600">
                                            100%
                                        </p>

                                        <p class="mt-1 text-sm text-slate-500">
                                            Free
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </section>


            <!-- ================= FEATURES ================= -->

            <section class="py-24 bg-white">

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                    <div class="text-center">

                        <span class="text-cyan-600 font-semibold uppercase tracking-widest text-sm">
                            Features
                        </span>

                        <h2 class="mt-4 text-4xl font-bold text-slate-900">
                            Everything You Need To Study Smarter
                        </h2>

                        <p class="mt-6 max-w-2xl mx-auto text-lg text-slate-600">

                            Spark Deck provides all the essential tools to help
                            students create, organize, discover, and study flashcards
                            more effectively.

                        </p>

                    </div>

                    <div class="mt-16 grid gap-8 md:grid-cols-2 xl:grid-cols-3">

                        <!-- Card -->

                        <article class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm transition duration-300 hover:-translate-y-2 hover:shadow-xl">

                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-cyan-100 text-3xl">

                                📚

                            </div>

                            <h3 class="mt-6 text-xl font-bold text-slate-900">
                                Create Decks
                            </h3>

                            <p class="mt-4 text-slate-600 leading-7">

                                Organize your study material into beautiful
                                flashcard decks for every class and subject.

                            </p>

                        </article>


                        <!-- Card -->

                        <article class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm transition duration-300 hover:-translate-y-2 hover:shadow-xl">

                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-100 text-3xl">

                                🌎

                            </div>

                            <h3 class="mt-6 text-xl font-bold text-slate-900">
                                Browse Community Decks
                            </h3>

                            <p class="mt-4 text-slate-600 leading-7">

                                Discover study resources created by other learners
                                and quickly find high-quality flashcard decks.

                            </p>

                        </article>


                        <!-- Card -->

                        <article class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm transition duration-300 hover:-translate-y-2 hover:shadow-xl">

                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-sky-100 text-3xl">

                                👍

                            </div>

                            <h3 class="mt-6 text-xl font-bold text-slate-900">
                                Community Upvotes
                            </h3>

                            <p class="mt-4 text-slate-600 leading-7">

                                Find the best study material through community
                                recommendations and upvoted flashcard decks.

                            </p>

                        </article>


                        <!-- Card -->

                        <article class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm transition duration-300 hover:-translate-y-2 hover:shadow-xl">

                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-cyan-100 text-3xl">

                                🔍

                            </div>

                            <h3 class="mt-6 text-xl font-bold text-slate-900">
                                Powerful Search
                            </h3>

                            <p class="mt-4 text-slate-600 leading-7">

                                Search by title, description,
                                and sort decks by popularity
                                or newest additions.

                            </p>

                        </article>


                        <!-- Card -->

                        <article class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm transition duration-300 hover:-translate-y-2 hover:shadow-xl">

                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-100 text-3xl">

                                🧠

                            </div>

                            <h3 class="mt-6 text-xl font-bold text-slate-900">
                                Focused Studying
                            </h3>

                            <p class="mt-4 text-slate-600 leading-7">

                                Study one flashcard at a time
                                with a distraction-free experience
                                that improves knowledge retention.

                            </p>

                        </article>


                        <!-- Card -->

                        <article class="rounded-3xl bg-gradient-to-br from-cyan-500 to-indigo-600 p-8 text-white shadow-xl">

                            <div class="text-4xl">

                                🚀

                            </div>

                            <h3 class="mt-6 text-2xl font-bold">
                                Learn Anywhere
                            </h3>

                            <p class="mt-4 leading-7 text-cyan-50">

                                Access your study material
                                from anywhere and prepare
                                for quizzes, exams,
                                and certifications with confidence.

                            </p>

                        </article>

                    </div>

                </div>

            </section>


            <!-- ================= HOW IT WORKS ================= -->

            <section class="py-24 bg-slate-50">

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                    <div class="text-center">

                        <span class="text-cyan-600 font-semibold uppercase tracking-widest text-sm">
                            How It Works
                        </span>

                        <h2 class="mt-4 text-4xl font-bold text-slate-900">
                            Start Studying in Minutes
                        </h2>

                        <p class="mt-6 max-w-2xl mx-auto text-lg text-slate-600">

                            Getting started with Spark Deck is simple. Create a deck,
                            add your flashcards, and begin studying immediately.

                        </p>

                    </div>

                    <div class="mt-20 grid md:grid-cols-3 gap-10">

                        <div class="text-center">

                            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-gradient-to-br from-cyan-500 to-indigo-600 text-white text-3xl font-bold shadow-lg">
                                1
                            </div>

                            <h3 class="mt-8 text-2xl font-semibold text-slate-900">
                                Create a Deck
                            </h3>

                            <p class="mt-4 text-slate-600 leading-7">

                                Organize your notes into subject-specific flashcard
                                decks that are easy to manage.

                            </p>

                        </div>


                        <div class="text-center">

                            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-gradient-to-br from-cyan-500 to-indigo-600 text-white text-3xl font-bold shadow-lg">
                                2
                            </div>

                            <h3 class="mt-8 text-2xl font-semibold text-slate-900">
                                Add Flashcards
                            </h3>

                            <p class="mt-4 text-slate-600 leading-7">

                                Create questions and answers that reinforce key
                                concepts and improve long-term memory.

                            </p>

                        </div>


                        <div class="text-center">

                            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-gradient-to-br from-cyan-500 to-indigo-600 text-white text-3xl font-bold shadow-lg">
                                3
                            </div>

                            <h3 class="mt-8 text-2xl font-semibold text-slate-900">
                                Study Anywhere
                            </h3>

                            <p class="mt-4 text-slate-600 leading-7">

                                Review your flashcards whenever you have time and
                                prepare confidently for your next exam.

                            </p>

                        </div>

                    </div>

                </div>

            </section>


            <!-- ================= CTA ================= -->

            <section class="py-24">

                <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

                    <div class="overflow-hidden rounded-[36px] bg-gradient-to-r from-cyan-500 via-sky-500 to-indigo-600 shadow-2xl">

                        <div class="px-8 py-20 text-center text-white">

                            <h2 class="text-4xl lg:text-5xl font-bold">
                                Ready to Study Smarter?
                            </h2>

                            <p class="mt-6 max-w-2xl mx-auto text-lg text-cyan-100 leading-8">

                                Join Spark Deck today and build your own flashcard
                                library, discover community decks, and master your
                                studies with confidence.

                            </p>

                            <!-- CTA Buttons -->

                            <div class="mt-10 flex flex-col sm:flex-row justify-center gap-4">

                                <a
                                    href="{{ route('register') }}"
                                    wire:navigate
                                    class="inline-flex min-w-[190px] items-center justify-center rounded-xl bg-white px-7 py-3.5 text-sm font-bold text-indigo-700 shadow-xl ring-1 ring-white/50 transition duration-300 hover:-translate-y-1 hover:bg-slate-50 hover:text-indigo-800 hover:shadow-2xl focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-600"
                                >
                                    Create Free Account
                                </a>

                                <a
                                    href="{{ route('browse-decks') }}"
                                    wire:navigate
                                    class="inline-flex min-w-[160px] items-center justify-center rounded-xl border-2 border-white bg-indigo-800 px-7 py-3.5 text-sm font-bold text-white shadow-xl transition duration-300 hover:-translate-y-1 hover:bg-white hover:text-indigo-700 hover:shadow-2xl focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-600"
                                >
                                    Browse Decks
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

        </main>


        <!-- ================= FOOTER ================= -->

        <footer class="border-t border-slate-200 bg-white">

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

                <div class="flex flex-col md:flex-row items-center justify-between gap-6">

                    <div>

                        <h3 class="text-lg font-bold text-slate-900">
                            Spark Deck
                        </h3>

                        <p class="mt-2 text-sm text-slate-500">
                            Learn smarter with collaborative flashcard studying.
                        </p>

                    </div>

                    <div class="flex items-center gap-8 text-sm">

                        <a
                            href="{{ route('browse-decks') }}"
                            wire:navigate
                            class="text-slate-500 hover:text-cyan-600 transition"
                        >
                            Browse Decks
                        </a>

                        @guest

                            <a
                                href="{{ route('login') }}"
                                wire:navigate
                                class="text-slate-500 hover:text-cyan-600 transition"
                            >
                                Log In
                            </a>

                            <a
                                href="{{ route('register') }}"
                                wire:navigate
                                class="text-slate-500 hover:text-cyan-600 transition"
                            >
                                Register
                            </a>

                        @endguest

                    </div>

                </div>

                <div class="mt-8 border-t border-slate-200 pt-6 text-center">

                    <p class="text-sm text-slate-500">
                        © {{ date('Y') }} Spark Deck. Built with Laravel, Livewire, Flux UI & Tailwind CSS.
                    </p>

                </div>

            </div>

        </footer>

    </div>

    @fluxScripts

    </body>
    </html>
</x-app-layout>