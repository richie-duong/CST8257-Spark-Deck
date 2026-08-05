<div>
    <div class="py-12">
        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
            <h1 class="mb-6 px-4 text-2xl font-semibold text-gray-900 sm:px-0">
                {{ __('Edit Deck') }}
            </h1>

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <form wire:submit="update" class="space-y-6 p-6">
                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input
                            id="title"
                            type="text"
                            class="mt-1 block w-full"
                            placeholder="{{ __('Enter a deck title') }}"
                            wire:model="title"
                        />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea
                            id="description"
                            rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="{{ __('Describe this deck') }}"
                            wire:model="description"
                        ></textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="visibility" :value="__('Visibility')" />
                        <select
                            id="visibility"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            wire:model="visibility"
                        >
                            <option value="private">{{ __('Private') }}</option>
                            <option value="public">{{ __('Public') }}</option>
                        </select>
                        <x-input-error :messages="$errors->get('visibility')" class="mt-2" />
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button>
                            {{ __('Save Changes') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
