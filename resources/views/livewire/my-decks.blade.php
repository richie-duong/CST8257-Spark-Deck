<div>
    <section class="relative overflow-hidden bg-gradient-to-br from-cyan-50 via-white to-indigo-50 py-16 sm:py-20">
        <div class="absolute -left-24 top-12 h-80 w-80 rounded-full bg-cyan-200/30 blur-3xl"></div>
        <div class="absolute right-0 top-0 h-96 w-96 rounded-full bg-indigo-200/30 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">
                <div class="max-w-3xl">
                    <span class="inline-flex rounded-full bg-cyan-100 px-4 py-2 text-sm font-semibold text-cyan-700">
                        Your Library
                    </span>
                    <h1 class="mt-5 text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">{{ __('My Decks') }}</h1>
                    <p class="mt-4 text-lg text-slate-600">Create focused study collections and manage every flashcard in one place.</p>
                </div>

                <a
                    href="{{ route('decks.create') }}"
                    class="inline-flex items-center justify-center rounded-full bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    wire:navigate
                >
                    {{ __('Create Deck') }}
                </a>
            </div>

            @if (session('status'))
                <div class="mt-8 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-800 shadow-sm">
                    {{ session('status') }}
                </div>
            @endif

            <div class="mt-12">
                @if ($decks->isEmpty())
                    <div class="rounded-3xl border border-slate-200 bg-white/90 p-12 text-center shadow-xl">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-cyan-100 text-2xl font-bold text-cyan-700">
                            +
                        </div>
                        <h2 class="mt-6 text-2xl font-bold text-slate-900">{{ __('No decks yet') }}</h2>
                        <p class="mx-auto mt-3 max-w-lg text-slate-600">{{ __('Create your first deck, then add flashcards and start studying.') }}</p>
                        <a
                            href="{{ route('decks.create') }}"
                            class="mt-7 inline-flex items-center justify-center rounded-full bg-indigo-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700"
                            wire:navigate
                        >
                            Create your first deck
                        </a>
                    </div>
                @else
                    <div class="grid gap-7 md:grid-cols-2 xl:grid-cols-3">
                        @foreach ($decks as $deck)
                            <article class="group flex h-full flex-col rounded-[28px] border border-slate-200 bg-white/90 p-7 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                                <div class="flex items-start justify-between gap-4">
                                    <h2 class="text-2xl font-bold text-slate-900 transition group-hover:text-cyan-700">{{ $deck->title }}</h2>
                                    <span class="rounded-full px-3 py-1 text-xs font-semibold capitalize {{ $deck->visibility === 'public' ? 'bg-cyan-100 text-cyan-700' : 'bg-slate-100 text-slate-600' }}">
                                        {{ $deck->visibility }}
                                    </span>
                                </div>

                                <p class="mt-5 flex-1 leading-7 text-slate-600">
                                    {{ $deck->description ?: __('No description available.') }}
                                </p>

                                <p class="mt-6 text-sm text-slate-400">
                                    {{ __('Created :date', ['date' => $deck->created_at->format('M j, Y')]) }}
                                </p>

                                <a
                                    href="{{ route('decks.flashcards', $deck) }}"
                                    class="mt-6 inline-flex items-center justify-center rounded-full bg-cyan-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-cyan-700"
                                    wire:navigate
                                >
                                    Manage Flashcards
                                </a>

                                <div class="mt-5 flex items-center justify-between border-t border-slate-200 pt-5">
                                    <a
                                        href="{{ route('decks.edit', $deck) }}"
                                        class="text-sm font-semibold text-indigo-600 hover:text-indigo-800"
                                        wire:navigate
                                    >
                                        {{ __('Edit Deck') }}
                                    </a>

                                    <button
                                        type="button"
                                        class="text-sm font-semibold text-red-600 hover:text-red-800"
                                        wire:click="delete({{ $deck->id }})"
                                        wire:confirm="{{ __('Are you sure you want to delete this deck?') }}"
                                    >
                                        {{ __('Delete') }}
                                    </button>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>
