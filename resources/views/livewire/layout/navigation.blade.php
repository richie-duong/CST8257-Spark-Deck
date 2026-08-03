<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
};

?>

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">

            <!-- Left Side -->
            <div class="flex">

                <!-- Logo -->
                <div class="shrink-0 flex items-center">

                    <a
                        href="{{ auth()->check() ? route('browse-decks') : url('/') }}"
                        wire:navigate
                    >
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>

                </div>

                <!-- Desktop Navigation -->
                <div class="hidden sm:flex sm:items-center sm:space-x-8 sm:ms-10">

                    @auth

                        <x-nav-link
                            :href="route('dashboard')"
                            :active="request()->routeIs('dashboard')"
                            wire:navigate
                        >
                            Dashboard
                        </x-nav-link>

                        <x-nav-link
                            :href="route('decks.index')"
                            :active="request()->routeIs('decks.*')"
                            wire:navigate
                        >
                            My Decks
                        </x-nav-link>

                    @else

                        <x-nav-link
                            :href="url('/')"
                            :active="request()->is('/')"
                            wire:navigate
                        >
                            Home
                        </x-nav-link>

                    @endauth

                    <x-nav-link
                        :href="route('browse-decks')"
                        :active="request()->routeIs('browse-decks')"
                        wire:navigate
                    >
                        Browse Decks
                    </x-nav-link>
                </div>

            </div>

            <!-- Right Side -->

            @auth

                <div class="hidden sm:flex sm:items-center sm:ms-6">

                    <x-dropdown align="right" width="48">

                        <x-slot name="trigger">

                            <button class="inline-flex items-center px-3 py-2 border border-transparent rounded-md text-sm text-gray-500 bg-white hover:text-gray-700 transition">

                                <div
                                    x-data="{ name: '{{ auth()->user()->name }}' }"
                                    x-text="name"
                                    x-on:profile-updated.window="name = $event.detail.name"
                                ></div>

                                <div class="ms-2">

                                    <svg
                                        class="fill-current h-4 w-4"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>

                                </div>

                            </button>

                        </x-slot>

                        <x-slot name="content">

                            <x-dropdown-link
                                :href="route('profile')"
                                wire:navigate
                            >
                                Profile
                            </x-dropdown-link>

                            <button
                                wire:click="logout"
                                class="w-full text-start"
                            >
                                <x-dropdown-link>
                                    Log Out
                                </x-dropdown-link>
                            </button>

                        </x-slot>

                    </x-dropdown>

                </div>

            @else

                <div class="hidden sm:flex sm:items-center gap-6">

                    <a
                        href="{{ route('login') }}"
                        wire:navigate
                        class="text-sm text-gray-600 hover:text-gray-900"
                    >
                        Log In
                    </a>

                    <a
                        href="{{ route('register') }}"
                        wire:navigate
                        class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700"
                    >
                        Register
                    </a>

                </div>

            @endauth

            <!-- Hamburger -->

            <div class="-me-2 flex items-center sm:hidden">

                <button
                    @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:bg-gray-100"
                >

                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path
                            :class="{ 'hidden': open, 'inline-flex': !open }"
                            class="inline-flex"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />

                        <path
                            :class="{ 'hidden': !open, 'inline-flex': open }"
                            class="hidden"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />

                    </svg>

                </button>

            </div>

        </div>

    </div>

        <!-- Responsive Navigation Menu -->
    <div
        :class="{ 'block': open, 'hidden': !open }"
        class="hidden sm:hidden"
    >

        <div class="pt-2 pb-3 space-y-1">

            @auth

                <x-responsive-nav-link
                    :href="route('dashboard')"
                    :active="request()->routeIs('dashboard')"
                    wire:navigate
                >
                    Dashboard
                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('decks.index')"
                    :active="request()->routeIs('decks.*')"
                    wire:navigate
                >
                    My Decks
                </x-responsive-nav-link>

            @else

                <x-responsive-nav-link
                    :href="url('/')"
                    :active="request()->is('/')"
                    wire:navigate
                >
                    Home
                </x-responsive-nav-link>

            @endauth

            <x-responsive-nav-link
                :href="route('browse-decks')"
                :active="request()->routeIs('browse-decks')"
                wire:navigate
            >
                Browse Decks
            </x-responsive-nav-link>

            @guest

                <x-responsive-nav-link
                    :href="route('login')"
                    wire:navigate
                >
                    Log In
                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('register')"
                    wire:navigate
                >
                    Register
                </x-responsive-nav-link>

            @endguest

        </div>

        @auth

            <div class="pt-4 pb-1 border-t border-gray-200">

                <div class="px-4">

                    <div
                        class="font-medium text-base text-gray-800"
                        x-data="{ name: '{{ auth()->user()->name }}' }"
                        x-text="name"
                        x-on:profile-updated.window="name = $event.detail.name"
                    ></div>

                    <div class="font-medium text-sm text-gray-500">
                        {{ auth()->user()->email }}
                    </div>

                </div>

                <div class="mt-3 space-y-1">

                    <x-responsive-nav-link
                        :href="route('profile')"
                        wire:navigate
                    >
                        Profile
                    </x-responsive-nav-link>

                    <button
                        wire:click="logout"
                        class="w-full text-start"
                    >
                        <x-responsive-nav-link>
                            Log Out
                        </x-responsive-nav-link>
                    </button>

                </div>

            </div>

        @endauth

    </div>

</nav>
