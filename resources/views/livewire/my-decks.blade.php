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

            @if ($decks->isEmpty())
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center text-gray-900">
                        <h2 class="text-lg font-medium">{{ __('No decks yet') }}</h2>
                        <p class="mt-2 text-sm text-gray-600">
                            {{ __('Your decks will appear here after you create one.') }}
                        </p>
                    </div>
                </div>
            @else
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($decks as $deck)
                        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <div class="flex items-start justify-between gap-4">
                                    <h2 class="text-lg font-medium text-gray-900">
                                        {{ $deck->title }}
                                    </h2>
                                    <span class="rounded-full bg-gray-100 px-2 py-1 text-xs font-medium capitalize text-gray-600">
                                        {{ $deck->visibility }}
                                    </span>
                                </div>

                                @if ($deck->description)
                                    <p class="mt-3 text-sm text-gray-600">
                                        {{ $deck->description }}
                                    </p>
                                @endif

                                <p class="mt-4 text-xs text-gray-500">
                                    {{ __('Created :date', ['date' => $deck->created_at->format('M j, Y')]) }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
