<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">

        {{-- Page header --}}
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold text-gray-800">
                Study — {{ $deck->title }}
            </h1>
            @auth
                <button wire:click="toggleCompleted"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md border transition
                               {{ $isCompleted
                                   ? 'bg-green-600 text-white border-green-600 hover:bg-green-700'
                                   : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50' }}">
                    {{ $isCompleted ? '✓ Completed' : 'Mark as Complete' }}
                </button>
            @endauth
        </div>

        @if ($total === 0)
            <div class="bg-white shadow-sm rounded-lg p-10 text-center">
                <p class="text-gray-500 text-lg">This deck has no flashcards yet.</p>
            </div>
        @else
            {{-- Progress bar --}}
            <div class="bg-white shadow-sm rounded-lg p-4">
                <div class="flex justify-between text-sm text-gray-500 mb-2">
                    <span>Card {{ $currentIndex + 1 }} of {{ $total }}</span>
                    <span>{{ round((($currentIndex + 1) / $total) * 100) }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-indigo-600 h-2 rounded-full transition-all duration-300"
                         style="width: {{ (($currentIndex + 1) / $total) * 100 }}%">
                    </div>
                </div>
            </div>

           {{-- Flashcard --}}
<div wire:key="card-{{ $currentIndex }}"
     x-data="{ flipped: @entangle('isFlipped') }"
     class="relative cursor-pointer min-h-64"
     @click="$wire.flipCard()">

   {{-- Front — Question --}}
<div x-show="!flipped"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0 scale-95"
     x-transition:enter-end="opacity-100 scale-100"
     x-transition:leave="transition ease-in duration-150"
     x-transition:leave-start="opacity-100 scale-100"
     x-transition:leave-end="opacity-0 scale-95"
     class="bg-white shadow-md rounded-xl p-8 flex flex-col items-center justify-center text-center min-h-64">
    <p class="text-xs uppercase tracking-widest text-indigo-400 font-semibold mb-4">Question</p>
    <p class="text-xl font-semibold text-gray-800 leading-relaxed">
        {{ $currentCard?->question ?? '—' }}
    </p>
    <p class="text-xs text-gray-400 mt-6">Click to reveal answer</p>
</div>

{{-- Back — Answer --}}
<div x-show="flipped"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0 scale-95"
     x-transition:enter-end="opacity-100 scale-100"
     x-transition:leave="transition ease-in duration-150"
     x-transition:leave-start="opacity-100 scale-100"
     x-transition:leave-end="opacity-0 scale-95"
     class="bg-indigo-600 shadow-md rounded-xl p-8 flex flex-col items-center justify-center text-center min-h-64">
    <p class="text-xs uppercase tracking-widest text-indigo-200 font-semibold mb-4">Answer</p>
    <p class="text-xl font-semibold text-white leading-relaxed">
        {{ $currentCard?->answer ?? '—' }}
    </p>
    <p class="text-xs text-indigo-300 mt-6">Click to see question</p>
</div>

            {{-- Navigation --}}
            <div class="flex items-center justify-between gap-4">
                <button wire:click="previousCard"
                        @disabled($currentIndex === 0)
                        class="flex-1 px-4 py-3 bg-white border border-gray-300 text-gray-700 rounded-lg font-medium
                               hover:bg-gray-50 disabled:opacity-40 disabled:cursor-not-allowed transition">
                    ← Previous
                </button>

                <button wire:click="restartDeck"
                        class="px-4 py-3 bg-white border border-gray-300 text-gray-500 rounded-lg text-sm hover:bg-gray-50 transition">
                    ↺ Restart
                </button>

                <button wire:click="nextCard"
                        @disabled($currentIndex === $total - 1)
                        class="flex-1 px-4 py-3 bg-white border border-gray-300 text-gray-700 rounded-lg font-medium
                               hover:bg-gray-50 disabled:opacity-40 disabled:cursor-not-allowed transition">
                    Next →
                </button>
            </div>

            {{-- Dot navigation --}}
            @if ($total <= 20)
                <div class="flex flex-wrap justify-center gap-2">
                    @foreach ($flashcards as $index => $card)
                        <button wire:click="goToCard({{ $index }})"
                                class="w-8 h-8 rounded-full text-xs font-semibold transition
                                       {{ $index === $currentIndex
                                           ? 'bg-indigo-600 text-white'
                                           : 'bg-gray-200 text-gray-600 hover:bg-gray-300' }}">
                            {{ $index + 1 }}
                        </button>
                    @endforeach
                </div>
            @endif

            {{-- End of deck --}}
            @if ($currentIndex === $total - 1)
                <div class="bg-green-50 border border-green-200 rounded-lg p-5 text-center">
                    <p class="text-green-800 font-semibold text-lg">🎉 You've reached the end!</p>
                    <p class="text-green-700 text-sm mt-1">
                        @auth
                            @if (! $isCompleted)
                                Don't forget to mark the deck as complete above.
                            @else
                                Great job — this deck is marked as complete.
                            @endif
                        @else
                            Log in to track your progress.
                        @endauth
                    </p>
                </div>
            @endif

        @endif

    </div>
</div>