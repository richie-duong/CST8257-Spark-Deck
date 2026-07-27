<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Study Deck') }}
        </h2>
    </x-slot>

    <livewire:pages.study-deck />
</x-app-layout>
