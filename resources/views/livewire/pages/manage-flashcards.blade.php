<section class="relative min-h-screen overflow-hidden bg-gradient-to-br from-cyan-50 via-white to-indigo-50 py-16">
    <div class="absolute -left-24 top-12 h-80 w-80 rounded-full bg-cyan-200/30 blur-3xl"></div>
    <div class="absolute right-0 top-0 h-96 w-96 rounded-full bg-indigo-200/30 blur-3xl"></div>

    <div class="relative mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

        {{-- Top navigation --}}
        <a
            href="{{ route('decks.index') }}"
            class="text-sm font-semibold text-indigo-600 hover:text-indigo-800"
            wire:navigate
        >
            ← Back to My Decks
        </a>

        {{-- Page header --}}
        <div class="mt-8 flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">

            <div>
                <span class="inline-flex rounded-full bg-cyan-100 px-4 py-2 text-sm font-semibold text-cyan-700">
                    Manage Deck
                </span>

                <h1 class="mt-5 text-4xl font-bold tracking-tight text-slate-900">
                    {{ $deck->title }}
                </h1>

                <p class="mt-3 text-lg text-slate-600">
                    Edit your deck and add flashcards to help learners study effectively.
                </p>
            </div>

            {{-- Header actions --}}
            <div class="flex flex-wrap items-center gap-3">

                @if (! $editingFlashcardId && ! $showCreateForm)

                    <button
                        type="button"
                        wire:click="toggleCreateForm"
                        class="inline-flex items-center justify-center rounded-full bg-cyan-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-cyan-700"
                    >
                        + New Flashcard
                    </button>

                @endif

                <a
                    href="{{ route('decks.study', $deck) }}"
                    class="inline-flex items-center justify-center rounded-full bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700"
                >
                    Study Deck
                </a>

            </div>

        </div>

        {{-- Success message --}}
        @if (session('success'))

            <div class="mt-8 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-800 shadow-sm">
                {{ session('success') }}
            </div>

        @endif


        {{-- Create / Edit Flashcard Form --}}
        @if ($showCreateForm || $editingFlashcardId)

            <div class="mt-10 rounded-3xl border border-slate-200 bg-white/90 p-6 shadow-xl sm:p-8">

                {{-- Create Flashcard --}}
                @if ($showCreateForm && ! $editingFlashcardId)

                    <form wire:submit="createFlashcard" class="space-y-6">

                        <div>
                            <h2 class="text-2xl font-bold text-slate-900">
                                Create Flashcard
                            </h2>

                            <p class="mt-2 text-slate-600">
                                Add a clear question and the answer learners should remember.
                            </p>
                        </div>

                        <div>
                            <x-input-label
                                for="question"
                                value="Question"
                                class="font-semibold text-slate-700"
                            />

                            <textarea
                                id="question"
                                wire:model="question"
                                rows="4"
                                class="mt-2 block w-full rounded-2xl border-slate-200 px-5 py-3 shadow-sm focus:border-cyan-400 focus:ring-cyan-200"
                                placeholder="Enter the question..."
                            ></textarea>

                            <x-input-error
                                :messages="$errors->get('question')"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <x-input-label
                                for="answer"
                                value="Answer"
                                class="font-semibold text-slate-700"
                            />

                            <textarea
                                id="answer"
                                wire:model="answer"
                                rows="4"
                                class="mt-2 block w-full rounded-2xl border-slate-200 px-5 py-3 shadow-sm focus:border-cyan-400 focus:ring-cyan-200"
                                placeholder="Enter the answer..."
                            ></textarea>

                            <x-input-error
                                :messages="$errors->get('answer')"
                                class="mt-2"
                            />
                        </div>

                        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                            <button
                                wire:click="toggleCreateForm"
                                type="button"
                                class="inline-flex items-center justify-center rounded-full border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                            >
                                Cancel
                            </button>

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center rounded-full bg-indigo-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700"
                            >
                                Save Flashcard
                            </button>

                        </div>

                    </form>

                @endif


                {{-- Edit Flashcard --}}
                @if ($editingFlashcardId)

                    <form wire:submit="updateFlashcard" class="space-y-6">

                        <div>
                            <h2 class="text-2xl font-bold text-slate-900">
                                Edit Flashcard
                            </h2>

                            <p class="mt-2 text-slate-600">
                                Update the question or answer, then save your changes.
                            </p>
                        </div>

                        <div>
                            <x-input-label
                                for="edit-question"
                                value="Question"
                                class="font-semibold text-slate-700"
                            />

                            <textarea
                                id="edit-question"
                                wire:model="question"
                                rows="4"
                                class="mt-2 block w-full rounded-2xl border-slate-200 px-5 py-3 shadow-sm focus:border-cyan-400 focus:ring-cyan-200"
                            ></textarea>

                            <x-input-error
                                :messages="$errors->get('question')"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <x-input-label
                                for="edit-answer"
                                value="Answer"
                                class="font-semibold text-slate-700"
                            />

                            <textarea
                                id="edit-answer"
                                wire:model="answer"
                                rows="4"
                                class="mt-2 block w-full rounded-2xl border-slate-200 px-5 py-3 shadow-sm focus:border-cyan-400 focus:ring-cyan-200"
                            ></textarea>

                            <x-input-error
                                :messages="$errors->get('answer')"
                                class="mt-2"
                            />
                        </div>

                        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                            <button
                                wire:click="cancelEditing"
                                type="button"
                                class="inline-flex items-center justify-center rounded-full border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                            >
                                Cancel
                            </button>

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center rounded-full bg-indigo-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700"
                            >
                                Update Flashcard
                            </button>

                        </div>

                    </form>

                @endif

            </div>

        @endif


        {{-- Empty Deck Community Warning --}}
        @if ($flashcards->isEmpty())

            <div class="mt-8 rounded-2xl border border-amber-200 bg-amber-50 px-5 py-4 shadow-sm">
                <div class="flex items-start gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-amber-100 text-lg font-bold text-amber-700">
                        !
                    </div>

                    <div>
                        <p class="font-semibold text-amber-900">
                            This deck isn't available to the community yet.
                        </p>

                        <p class="mt-1 text-sm leading-6 text-amber-800">
                            Add at least one flashcard before other users can view this deck in the community.
                        </p>
                    </div>

                </div>
            </div>

        @endif


        {{-- Flashcards --}}
        <div class="mt-8 rounded-3xl border border-slate-200 bg-white/90 p-6 shadow-xl sm:p-8">

            {{-- Flashcards header --}}
            <div class="flex items-center justify-between">

                <div>
                    <h2 class="text-2xl font-bold text-slate-900">
                        Flashcards
                    </h2>

                    <p class="mt-2 text-slate-500">
                        Review and maintain the cards in this deck.
                    </p>
                </div>

                <span class="text-sm text-slate-500">
                    {{ $flashcards->count() }} card(s) in this deck
                </span>

            </div>


            {{-- Empty state --}}
            @if ($flashcards->isEmpty())

                <div class="mt-8 rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-10 text-center">

                    <p class="font-semibold text-slate-700">
                        No flashcards yet
                    </p>

                    <p class="mt-2 text-sm text-slate-500">
                        Click <strong>+ New Flashcard</strong> above to add the first one.
                    </p>

                </div>

            @else

                {{-- Flashcard list --}}
                <ul class="mt-8 space-y-4">

                    @foreach ($flashcards as $flashcard)

                        <li
                            class="rounded-2xl border border-slate-200 bg-white p-5 transition hover:border-cyan-200 hover:shadow-sm
                                {{ $editingFlashcardId === $flashcard->id
                                    ? 'border-indigo-300 bg-indigo-50'
                                    : '' }}"
                        >

                            {{-- Question + Actions --}}
                            <div class="flex items-start justify-between gap-5">

                                {{-- Question --}}
                                <div class="min-w-0 flex-1">

                                    <p class="text-xs font-semibold uppercase tracking-wider text-cyan-700">
                                        Question
                                    </p>

                                    <p class="mt-2 break-words text-base leading-7 text-slate-800">
                                        {{ $flashcard->question }}
                                    </p>

                                </div>


                                {{-- Actions --}}
                                <div class="flex shrink-0 items-center gap-3">

                                    <button
                                        type="button"
                                        wire:click="startEditing({{ $flashcard->id }})"
                                        class="rounded-full bg-amber-100 px-4 py-2 text-sm font-semibold text-amber-700 transition hover:bg-amber-200"
                                    >
                                        Edit
                                    </button>

                                    <button
                                        type="button"
                                        wire:click="deleteFlashcard({{ $flashcard->id }})"
                                        wire:confirm="Permanently delete this flashcard? This cannot be undone."
                                        class="rounded-full bg-red-50 px-4 py-2 text-sm font-semibold text-red-700 transition hover:bg-red-100"
                                    >
                                        Delete
                                    </button>

                                </div>

                            </div>


                            {{-- Full-width Answer --}}
                            <div class="mt-5 w-full rounded-xl border border-emerald-100 bg-emerald-50 px-4 py-3">

                                <p class="text-xs font-semibold uppercase tracking-wider text-emerald-600">
                                    Answer
                                </p>

                                <p class="mt-2 break-words text-base font-medium leading-7 text-emerald-700">
                                    {{ $flashcard->answer }}
                                </p>

                            </div>

                        </li>

                    @endforeach

                </ul>

            @endif

        </div>

    </div>

</section>