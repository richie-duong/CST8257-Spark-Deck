<?php

use Livewire\Volt\Component;

new class extends Component {
    // TODO: Add search/filter state and public deck query integration.
}; ?>

<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <header>
            <h1 class="text-2xl font-semibold text-gray-900">{{ __('Discover Community Decks') }}</h1>
            <p class="mt-1 text-sm text-gray-600">
                {{ __('Explore decks shared by other learners and find new material to study.') }}
            </p>
        </header>

        <section aria-label="Browse controls" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 sm:p-8 space-y-6">
                <div>
                    <label for="search-placeholder" class="block text-sm font-medium text-gray-700">{{ __('Search Public Decks') }}</label>
                    <!-- TODO: Bind this input to Livewire search state. -->
                    <input
                        id="search-placeholder"
                        type="search"
                        placeholder="{{ __('Search by title, topic, or creator...') }}"
                        class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        disabled
                    />
                </div>

                <div>
                    <p class="text-sm font-medium text-gray-700">{{ __('Filter By') }}</p>
                    <!-- TODO: Connect filter actions to sorting/filter query params. -->
                    <div class="mt-3 flex flex-wrap gap-3">
                        <flux:button variant="filled" size="sm" disabled>{{ __('Newest') }}</flux:button>
                        <flux:button variant="ghost" size="sm" disabled>{{ __('Most Popular') }}</flux:button>
                        <flux:button variant="ghost" size="sm" disabled>{{ __('Completed') }}</flux:button>
                    </div>
                </div>
            </div>
        </section>

        <section aria-labelledby="public-decks-grid" class="space-y-4">
            <h2 id="public-decks-grid" class="text-lg font-medium text-gray-900">{{ __('Public Decks') }}</h2>
            <p class="text-sm text-gray-600">{{ __('This responsive grid is ready for real public deck cards.') }}</p>

            <!-- TODO: Loop over public decks and render card metadata, votes, and completion status. -->
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <article class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200">
                    <div class="h-4 w-3/4 rounded bg-gray-200"></div>
                    <div class="mt-3 h-3 w-full rounded bg-gray-100"></div>
                    <div class="mt-2 h-3 w-5/6 rounded bg-gray-100"></div>
                    <div class="mt-4 flex items-center justify-between text-xs text-gray-500">
                        <span>{{ __('Votes: --') }}</span>
                        <span>{{ __('Cards: --') }}</span>
                    </div>
                </article>

                <article class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200">
                    <div class="h-4 w-2/3 rounded bg-gray-200"></div>
                    <div class="mt-3 h-3 w-full rounded bg-gray-100"></div>
                    <div class="mt-2 h-3 w-3/4 rounded bg-gray-100"></div>
                    <div class="mt-4 flex items-center justify-between text-xs text-gray-500">
                        <span>{{ __('Votes: --') }}</span>
                        <span>{{ __('Cards: --') }}</span>
                    </div>
                </article>

                <article class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200 sm:col-span-2 lg:col-span-1">
                    <div class="h-4 w-4/5 rounded bg-gray-200"></div>
                    <div class="mt-3 h-3 w-full rounded bg-gray-100"></div>
                    <div class="mt-2 h-3 w-2/3 rounded bg-gray-100"></div>
                    <div class="mt-4 flex items-center justify-between text-xs text-gray-500">
                        <span>{{ __('Votes: --') }}</span>
                        <span>{{ __('Cards: --') }}</span>
                    </div>
                </article>
            </div>
        </section>
    </div>
</section>
