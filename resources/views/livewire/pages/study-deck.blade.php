<section class="relative overflow-hidden bg-gradient-to-br from-cyan-50 via-white to-indigo-50 py-16">
    <div class="absolute -left-24 top-12 h-80 w-80 rounded-full bg-cyan-200/30 blur-3xl"></div>
    <div class="absolute right-0 top-0 h-96 w-96 rounded-full bg-indigo-200/30 blur-3xl"></div>

    <div class="relative mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">

        {{-- Top navigation --}}
        <div class="flex items-center justify-between">
            <button
                onclick="history.back()"
                class="text-sm font-semibold text-indigo-600 hover:text-indigo-800"
            >
                ← Go Back
            </button>

            @auth
                @if (Auth::id() === $deck->user_id)
                    
                       <a href="{{ route('decks.flashcards', $deck) }}"
                        class="inline-flex items-center justify-center rounded-full bg-cyan-600 px-5 py-2 text-sm font-semibold text-white transition hover:bg-cyan-700"
                    >
                        Manage Flashcards
                    </a>
                @endif
            @endauth
        </div>

        {{-- Page header --}}
        <div class="mt-8 flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <span class="inline-flex rounded-full bg-cyan-100 px-4 py-2 text-sm font-semibold text-cyan-700">
                    Study Session
                </span>
                <h1 class="mt-5 text-4xl font-bold tracking-tight text-slate-900">{{ $deck->title }}</h1>
                <p class="mt-3 text-lg text-slate-600">Work through each card and check your understanding.</p>
            </div>

            @if ($total > 0)
                @auth
                    <button
                        type="button"
                        wire:click="toggleCompleted"
                        class="inline-flex items-center justify-center rounded-full border px-6 py-3 text-sm font-semibold transition
                            {{ $isCompleted
                                ? 'border-emerald-600 bg-emerald-600 text-white hover:bg-emerald-700'
                                : 'border-slate-300 bg-white text-slate-700 hover:bg-slate-50' }}"
                    >
                        {{ $isCompleted ? 'Completed' : 'Mark as Complete' }}
                    </button>
                @endauth
            @endif
        </div>

        {{-- Empty state --}}
        @if ($total === 0)
            <div class="mt-10 rounded-3xl border border-slate-200 bg-white/90 p-12 text-center shadow-xl">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-cyan-100 text-2xl font-bold text-cyan-700">
                    0
                </div>
                <h2 class="mt-6 text-2xl font-bold text-slate-900">No flashcards yet</h2>
                <p class="mt-3 text-slate-600">Add cards to this deck before starting a study session.</p>
                @auth
                    @if (Auth::id() === $deck->user_id)
                        
                            href="{{ route('decks.flashcards', $deck) }}"
                            class="mt-7 inline-flex items-center justify-center rounded-full bg-indigo-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700"
                        >
                            Manage Cards
                        </a>
                    @endif
                @endauth
            </div>

        {{-- Study mode --}}
        @else

            {{-- Progress bar --}}
            <div class="mt-10 rounded-3xl border border-slate-200 bg-white/90 p-5 shadow-lg">
                <div class="flex justify-between text-sm font-medium text-slate-500">
                    <span>Card {{ $currentIndex + 1 }} of {{ $total }}</span>
                    <span>{{ round((($currentIndex + 1) / $total) * 100) }}%</span>
                </div>
                <div class="mt-3 h-2.5 w-full overflow-hidden rounded-full bg-slate-200">
                    <div
                        class="h-2.5 rounded-full bg-gradient-to-r from-cyan-500 to-indigo-600 transition-all duration-300"
                        style="width: {{ (($currentIndex + 1) / $total) * 100 }}%"
                    ></div>
                </div>
            </div>

           {{-- Flashcard --}}
        <style>
                .flashcard-inner {
                    position: relative;
                    width: 100%;
                    min-height: 320px;
                    transform-style: preserve-3d;
                    transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
                }
                .flashcard-inner.is-flipped {
                    transform: rotateY(180deg);
                }
                .flashcard-front,
                .flashcard-back {
                    position: absolute;
                    inset: 0;
                    backface-visibility: hidden;
                    -webkit-backface-visibility: hidden;
                    border-radius: 1.5rem;
                }
                .flashcard-back {
                    transform: rotateY(180deg);
                }
            </style>

            <div
                wire:key="card-{{ $currentIndex }}-{{ $resetCount }}"
                x-data="{ flipped: false }"
                class="mt-8 cursor-pointer"
                style="perspective: 1200px;"
                @click="flipped = !flipped"
            >
                <div class="flashcard-inner" :class="{ 'is-flipped': flipped }">

                    {{-- Front - Question --}}
                    <div class="flashcard-front flex flex-col items-center justify-center border border-slate-200 bg-white p-8 text-center shadow-xl sm:p-12">
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-cyan-600">Question</p>
                        <p class="mt-6 text-2xl font-bold leading-relaxed text-slate-900">{{ $currentCard?->question ?? '—' }}</p>
                        <p class="mt-8 text-sm text-slate-400">Click the card to reveal the answer</p>
                    </div>

                    {{-- Back - Answer --}}
                    <div class="flashcard-back flex flex-col items-center justify-center bg-gradient-to-br from-cyan-600 to-indigo-700 p-8 text-center shadow-xl sm:p-12">
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-cyan-100">Answer</p>
                        <p class="mt-6 text-2xl font-bold leading-relaxed text-white">{{ $currentCard?->answer ?? '—' }}</p>
                        <p class="mt-8 text-sm text-indigo-100">Click the card to see the question</p>
                    </div>

                </div>
            </div>

            {{-- Navigation --}}
            <div class="mt-8 grid grid-cols-3 gap-3">
                <button
                    type="button"
                    wire:click="previousCard"
                    @disabled($currentIndex === 0)
                    class="rounded-full border border-slate-300 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 disabled:cursor-not-allowed disabled:opacity-40"
                >
                    ← Previous
                </button>

                <button
                    type="button"
                    wire:click="restartDeck"
                    class="rounded-full border border-slate-300 bg-white px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                >
                    Restart
                </button>

                <button
                    type="button"
                    wire:click="nextCard"
                    @disabled($currentIndex === $total - 1)
                    class="rounded-full bg-indigo-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700 disabled:cursor-not-allowed disabled:opacity-40"
                >
                    Next →
                </button>
            </div>

            {{-- Dot navigation --}}
            @if ($total <= 20)
                <div class="mt-7 flex flex-wrap justify-center gap-2">
                    @foreach ($flashcards as $index => $card)
                        <button
                            type="button"
                            wire:click="goToCard({{ $index }})"
                            class="h-9 w-9 rounded-full text-xs font-semibold transition
                                {{ $index === $currentIndex
                                    ? 'bg-indigo-600 text-white shadow'
                                    : 'bg-white text-slate-600 hover:bg-cyan-100 hover:text-cyan-700' }}"
                        >
                            {{ $index + 1 }}
                        </button>
                    @endforeach
                </div>
            @endif

            {{-- End of deck --}}
            @if ($currentIndex === $total - 1)
                <div class="mt-8 rounded-3xl border border-emerald-200 bg-emerald-50 p-6 text-center shadow-sm">
                    <h2 class="text-xl font-bold text-emerald-800">You reached the end!</h2>
                    <p class="mt-2 text-sm text-emerald-700">
                        @auth
                            @if (! $isCompleted)
                                Mark the deck as complete when you are finished reviewing.
                            @else
                                Great job—this deck is marked as complete.
                            @endif
                        @else
                            Log in to track your progress.
                        @endauth
                    </p>
                </div>
            @endif

        @endif

    </div>
</section>