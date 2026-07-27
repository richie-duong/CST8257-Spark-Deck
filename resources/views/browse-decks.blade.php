<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Browse Decks') }}
        </h2>
    </x-slot>

    <livewire:pages.browse-decks />
</x-app-layout>
