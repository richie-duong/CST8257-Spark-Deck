<div>
    <section class="relative overflow-hidden bg-gradient-to-br from-cyan-50 via-white to-indigo-50 py-16">
        <div class="absolute -left-24 top-12 h-80 w-80 rounded-full bg-cyan-200/30 blur-3xl"></div>
        <div class="absolute right-0 top-0 h-96 w-96 rounded-full bg-indigo-200/30 blur-3xl"></div>

        <div class="relative mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <a href="{{ route('decks.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800" wire:navigate>
                ← Back to My Decks
            </a>

            <div class="mt-8">
                <div>
                    <span class="inline-flex rounded-full bg-cyan-100 px-4 py-2 text-sm font-semibold text-cyan-700">
                        Deck Settings
                    </span>
                    <h1 class="mt-5 text-4xl font-bold tracking-tight text-slate-900">{{ __('Edit Deck') }}</h1>
                    <p class="mt-3 text-lg text-slate-600">Update the deck title, description, or visibility.</p>
                </div>
            </div>

            <div class="mt-10 rounded-3xl border border-slate-200 bg-white/90 p-6 shadow-xl sm:p-8">
                <form wire:submit="update" class="space-y-7">
                    <div>
                        <x-input-label for="title" :value="__('Title')" class="font-semibold text-slate-700" />
                        <x-text-input
                            id="title"
                            type="text"
                            class="mt-2 block w-full rounded-2xl border-slate-200 px-5 py-3 focus:border-cyan-400 focus:ring-cyan-200"
                            placeholder="{{ __('Enter a deck title') }}"
                            wire:model="title"
                        />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Description')" class="font-semibold text-slate-700" />
                        <textarea
                            id="description"
                            rows="5"
                            class="mt-2 block w-full rounded-2xl border-slate-200 px-5 py-3 shadow-sm focus:border-cyan-400 focus:ring-cyan-200"
                            placeholder="{{ __('Describe this deck') }}"
                            wire:model="description"
                        ></textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="visibility" :value="__('Visibility')" class="font-semibold text-slate-700" />
                        <select
                            id="visibility"
                            class="mt-2 block w-full rounded-2xl border-slate-200 px-5 py-3 shadow-sm focus:border-cyan-400 focus:ring-cyan-200"
                            wire:model="visibility"
                        >
                            <option value="private">{{ __('Private') }}</option>
                            <option value="public">{{ __('Public') }}</option>
                        </select>
                        <x-input-error :messages="$errors->get('visibility')" class="mt-2" />
                    </div>

                    <div class="flex flex-col gap-4 border-t border-slate-200 pt-6 sm:flex-row sm:items-center sm:justify-between">
                        <button
                            type="button"
                            class="inline-flex items-center justify-center rounded-full bg-red-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                            wire:click="delete"
                            wire:confirm="{{ __('Permanently delete this deck and all flashcards inside it? This cannot be undone.') }}"
                        >
                            {{ __('Delete Deck') }}
                        </button>

                        <div class="flex flex-col-reverse gap-3 sm:flex-row">
                            <a
                                href="{{ route('decks.index') }}"
                                class="inline-flex items-center justify-center rounded-full border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                                wire:navigate
                            >
                                Cancel
                            </a>
                            <button
                                type="submit"
                                class="inline-flex items-center justify-center rounded-full bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            >
                                {{ __('Save Changes') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
