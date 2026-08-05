<x-app-layout>
    <section class="relative overflow-hidden bg-gradient-to-br from-cyan-50 via-white to-indigo-50 py-16 sm:py-20">
        <div class="absolute -left-24 top-12 h-80 w-80 rounded-full bg-cyan-200/30 blur-3xl"></div>
        <div class="absolute right-0 top-0 h-96 w-96 rounded-full bg-indigo-200/30 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <span class="inline-flex rounded-full bg-cyan-100 px-4 py-2 text-sm font-semibold text-cyan-700">
                    Your Study Space
                </span>

                <h1 class="mt-6 text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">
                    Welcome back, {{ auth()->user()->name }}
                </h1>

                <p class="mt-5 text-lg leading-8 text-slate-600">
                    Build your own flashcard decks, study at your pace, or discover material shared by the community.
                </p>
            </div>

            <div class="mt-12 grid gap-6 md:grid-cols-3">
                <a
                    href="{{ route('decks.index') }}"
                    class="group rounded-3xl border border-slate-200 bg-white/90 p-7 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl"
                    wire:navigate
                >
                    <span class="text-sm font-semibold text-cyan-700">Build</span>
                    <h2 class="mt-3 text-2xl font-bold text-slate-900 group-hover:text-cyan-700">My Decks</h2>
                    <p class="mt-3 leading-7 text-slate-600">Create decks, update their details, and manage the flashcards inside them.</p>
                    <span class="mt-6 inline-flex font-semibold text-indigo-600">Open my decks →</span>
                </a>

                <a
                    href="{{ route('browse-decks') }}"
                    class="group rounded-3xl border border-slate-200 bg-white/90 p-7 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl"
                    wire:navigate
                >
                    <span class="text-sm font-semibold text-cyan-700">Discover</span>
                    <h2 class="mt-3 text-2xl font-bold text-slate-900 group-hover:text-cyan-700">Browse Decks</h2>
                    <p class="mt-3 leading-7 text-slate-600">Explore public decks from other learners and find something new to study.</p>
                    <span class="mt-6 inline-flex font-semibold text-indigo-600">Browse the library →</span>
                </a>

                <a
                    href="{{ route('profile') }}"
                    class="group rounded-3xl border border-slate-200 bg-white/90 p-7 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl"
                    wire:navigate
                >
                    <span class="text-sm font-semibold text-cyan-700">Account</span>
                    <h2 class="mt-3 text-2xl font-bold text-slate-900 group-hover:text-cyan-700">Profile Settings</h2>
                    <p class="mt-3 leading-7 text-slate-600">Keep your profile details and account security information up to date.</p>
                    <span class="mt-6 inline-flex font-semibold text-indigo-600">Manage profile →</span>
                </a>
            </div>
        </div>
    </section>
</x-app-layout>
