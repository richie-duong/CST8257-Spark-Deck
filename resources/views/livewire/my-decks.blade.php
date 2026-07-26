<div>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-6 flex items-center justify-between px-4 sm:px-0">
                <h1 class="text-2xl font-semibold text-gray-900">{{ __('My Decks') }}</h1>

                <a
                    href="{{ route('decks.create') }}"
                    class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    wire:navigate
                >
                    {{ __('Create Deck') }}
                </a>
            </div>

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-center text-gray-900">
                    <h2 class="text-lg font-medium">{{ __('No decks yet') }}</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        {{ __('Your decks will appear here after you create one.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
