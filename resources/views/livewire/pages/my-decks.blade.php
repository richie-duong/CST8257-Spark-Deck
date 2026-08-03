<?php

use Livewire\Volt\Component;

new class extends Component {
    // TODO: Add deck-loading and pagination state for the authenticated user.
}; ?>

<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <header class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">{{ __('Build Your Study Library') }}</h1>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Create, organize, and refine your personal flashcard decks in one place.') }}
                </p>
            </div>

            <!-- TODO: Wire this action to a deck-creation flow or modal. -->
            <flux:button
                as="a"
                href="{{ route('create-deck') }}"
                variant="primary"
                icon="plus"
                class="w-full sm:w-auto justify-center"
            >
                {{ __('Create Deck') }}
            </flux:button>
        </header>

        <section aria-labelledby="my-decks-placeholder" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 sm:p-8">
                <h2 id="my-decks-placeholder" class="text-lg font-medium text-gray-900">{{ __('Your Deck Collection') }}</h2>
                <p class="mt-1 text-sm text-gray-600">{{ __('Deck cards will appear here once data binding is implemented.') }}</p>

                <!-- TODO: Replace placeholders with real deck cards rendered from user-owned decks. -->
                <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3" aria-hidden="true">
                    <div class="rounded-xl border border-dashed border-gray-300 bg-gray-50 p-5">
                        <div class="h-4 w-2/3 rounded bg-gray-200"></div>
                        <div class="mt-3 h-3 w-full rounded bg-gray-100"></div>
                        <div class="mt-2 h-3 w-5/6 rounded bg-gray-100"></div>
                    </div>
                    <div class="rounded-xl border border-dashed border-gray-300 bg-gray-50 p-5">
                        <div class="h-4 w-1/2 rounded bg-gray-200"></div>
                        <div class="mt-3 h-3 w-full rounded bg-gray-100"></div>
                        <div class="mt-2 h-3 w-3/4 rounded bg-gray-100"></div>
                    </div>
                    <div class="rounded-xl border border-dashed border-gray-300 bg-gray-50 p-5 sm:col-span-2 lg:col-span-1">
                        <div class="h-4 w-3/5 rounded bg-gray-200"></div>
                        <div class="mt-3 h-3 w-full rounded bg-gray-100"></div>
                        <div class="mt-2 h-3 w-2/3 rounded bg-gray-100"></div>
                    </div>
                </div>

                <!-- TODO: Replace with conditional rendering based on actual deck count. -->
                <div class="mt-8 rounded-lg border border-dashed border-gray-300 bg-gray-50 px-4 py-8 text-center">
                    <p class="text-sm font-medium text-gray-700">{{ __('No decks yet.') }}</p>
                    <p class="mt-1 text-sm text-gray-500">
                        {{ __('Create your first deck to begin building your study routine.') }}
                    </p>
                </div>
            </div>
        </section>
    </div>
</section>
