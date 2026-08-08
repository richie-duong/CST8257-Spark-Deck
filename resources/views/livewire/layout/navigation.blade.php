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

<nav
    x-data="{ open: false }"
    class="relative z-[9999] border-b border-slate-200/80 bg-white/95 shadow-sm backdrop-blur"
>

    <!-- Subtle accent line -->

    <div class="absolute inset-x-0 bottom-0 h-px bg-gradient-to-r from-transparent via-cyan-300/60 to-transparent"></div>


    <!-- ========================================================== -->
    <!-- NAVBAR -->
    <!-- ========================================================== -->

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="flex h-[72px] items-center justify-between">


            <!-- ================================================== -->
            <!-- LEFT SIDE -->
            <!-- ================================================== -->

            <div class="flex items-center">


                <!-- Logo -->

                <div class="shrink-0">

                    <a
                        href="{{ auth()->check() ? route('browse-decks') : url('/') }}"
                        wire:navigate
                        class="group flex items-center gap-3"
                    >

                        <div
                            class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-cyan-100 to-indigo-100 shadow-sm transition duration-300 group-hover:-translate-y-0.5 group-hover:shadow-md"
                        >

                            <x-application-logo
                                class="block h-7 w-auto fill-current text-slate-800"
                            />

                        </div>


                        <!-- Brand Name -->

                        <span class="hidden text-lg font-bold tracking-tight text-slate-900 lg:block">
                            Spark<span class="text-indigo-600">Deck</span>
                        </span>

                    </a>

                </div>


                <!-- ================================================== -->
                <!-- DESKTOP PAGE NAVIGATION -->
                <!-- ================================================== -->

                <div class="ml-10 hidden items-center gap-2 sm:flex">

                    @auth

                        <!-- Dashboard -->

                        <a
                            href="{{ route('dashboard') }}"
                            wire:navigate
                            class="inline-flex items-center rounded-xl px-4 py-2.5 text-sm font-semibold transition duration-200
                                {{ request()->routeIs('dashboard')
                                    ? 'bg-indigo-50 text-indigo-700 shadow-sm'
                                    : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}"
                        >
                            Dashboard
                        </a>


                        <!-- My Decks -->

                        <a
                            href="{{ route('decks.index') }}"
                            wire:navigate
                            class="inline-flex items-center rounded-xl px-4 py-2.5 text-sm font-semibold transition duration-200
                                {{ request()->routeIs('decks.*')
                                    ? 'bg-cyan-50 text-cyan-700 shadow-sm'
                                    : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}"
                        >
                            My Decks
                        </a>


                        <!-- Browse Decks -->

                        <a
                            href="{{ route('browse-decks') }}"
                            wire:navigate
                            class="inline-flex items-center rounded-xl px-4 py-2.5 text-sm font-semibold transition duration-200
                                {{ request()->routeIs('browse-decks')
                                    ? 'bg-indigo-50 text-indigo-700 shadow-sm'
                                    : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}"
                        >
                            Browse Decks
                        </a>

                    @else

                        <!-- Home -->

                        <a
                            href="{{ url('/') }}"
                            wire:navigate
                            class="inline-flex items-center rounded-xl px-4 py-2.5 text-sm font-semibold transition duration-200
                                {{ request()->is('/')
                                    ? 'bg-indigo-50 text-indigo-700 shadow-sm'
                                    : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}"
                        >
                            Home
                        </a>


                        <!-- Browse Decks -->

                        <a
                            href="{{ route('browse-decks') }}"
                            wire:navigate
                            class="inline-flex items-center rounded-xl px-4 py-2.5 text-sm font-semibold transition duration-200
                                {{ request()->routeIs('browse-decks')
                                    ? 'bg-indigo-50 text-indigo-700 shadow-sm'
                                    : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}"
                        >
                            Browse Decks
                        </a>

                    @endauth

                </div>

            </div>


            <!-- ================================================== -->
            <!-- DESKTOP ACCOUNT -->
            <!-- ================================================== -->

            @auth

                <div
                    class="relative hidden sm:flex sm:items-center"
                    x-data="{ userMenuOpen: false }"
                >

                    <!-- User Button -->

                    <button
                        type="button"
                        @click="userMenuOpen = !userMenuOpen"
                        @click.outside="userMenuOpen = false"
                        class="group inline-flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition duration-200 hover:border-slate-300 hover:bg-slate-50"
                    >

                        <!-- Avatar -->

                        <div
                            class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-cyan-100 to-indigo-100 text-sm font-bold text-indigo-700"
                        >
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>


                        <!-- Name -->

                        <span class="max-w-[140px] truncate">
                            {{ auth()->user()->name }}
                        </span>


                        <!-- Chevron -->

                        <svg
                            class="h-4 w-4 text-slate-400 transition-transform duration-200"
                            :class="{ 'rotate-180': userMenuOpen }"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >

                            <path
                                fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            />

                        </svg>

                    </button>


                    <!-- Desktop Dropdown -->

                    <div
                        x-show="userMenuOpen"
                        x-cloak
                        class="absolute right-0 top-full z-[99999] mt-3 w-64 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-2xl"
                    >

                        <!-- User Information -->

                        <div class="border-b border-slate-100 bg-slate-50 px-4 py-4">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-gradient-to-br from-cyan-100 to-indigo-100 text-sm font-bold text-indigo-700"
                                >
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>

                                <div class="min-w-0">

                                    <p class="truncate text-sm font-semibold text-slate-900">
                                        {{ auth()->user()->name }}
                                    </p>

                                    <p class="mt-0.5 truncate text-xs text-slate-500">
                                        {{ auth()->user()->email }}
                                    </p>

                                </div>

                            </div>

                        </div>


                        <!-- Profile -->

                        <a
                            href="{{ route('profile') }}"
                            wire:navigate
                            @click="userMenuOpen = false"
                            class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-slate-700 transition hover:bg-cyan-50 hover:text-cyan-700"
                        >

                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-lg bg-cyan-100 text-cyan-700"
                            >

                                <svg
                                    class="h-4 w-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                    />

                                </svg>

                            </div>

                            Profile

                        </a>


                        <!-- Logout -->

                        <button
                            type="button"
                            wire:click="logout"
                            @click="userMenuOpen = false"
                            class="flex w-full items-center gap-3 border-t border-slate-100 px-4 py-3 text-left text-sm font-medium text-slate-700 transition hover:bg-red-50 hover:text-red-600"
                        >

                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-lg bg-red-50 text-red-500"
                            >

                                <svg
                                    class="h-4 w-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 013 3v-1"
                                    />

                                </svg>

                            </div>

                            Log Out

                        </button>

                    </div>

                </div>


            @else

                <!-- Guest Actions -->

                <div class="hidden items-center gap-3 sm:flex">

                    <a
                        href="{{ route('login') }}"
                        wire:navigate
                        class="rounded-xl px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                    >
                        Log In
                    </a>

                    <a
                        href="{{ route('register') }}"
                        wire:navigate
                        class="rounded-xl bg-gradient-to-r from-cyan-500 to-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition duration-300 hover:-translate-y-0.5 hover:shadow-md"
                    >
                        Get Started
                    </a>

                </div>

            @endauth


            <!-- ================================================== -->
            <!-- MOBILE MENU BUTTON -->
            <!-- ================================================== -->

            <div class="-me-2 flex items-center sm:hidden">

                <button
                    type="button"
                    @click="open = !open"
                    class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white p-2.5 text-slate-600 shadow-sm transition hover:bg-slate-50"
                    aria-label="Toggle navigation menu"
                >

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <!-- Hamburger -->

                        <path
                            x-show="!open"
                            x-cloak
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />


                        <!-- Close -->

                        <path
                            x-show="open"
                            x-cloak
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


    <!-- ========================================================== -->
    <!-- MOBILE NAVIGATION -->
    <!-- ========================================================== -->

    <div
        :class="{ 'block': open, 'hidden': !open }"
        class="hidden border-t border-slate-100 bg-white sm:hidden"
    >

        <div class="px-4 pb-5 pt-4">


            <!-- ================================================== -->
            <!-- PAGE NAVIGATION -->
            <!-- ================================================== -->

            <div class="space-y-1">

                <p class="px-4 pb-2 text-xs font-semibold uppercase tracking-wider text-slate-400">
                    Navigation
                </p>


                @auth

                    <!-- Dashboard -->

                    <a
                        href="{{ route('dashboard') }}"
                        wire:navigate
                        @click="open = false"
                        class="flex items-center rounded-xl px-4 py-3 text-sm font-semibold transition
                            {{ request()->routeIs('dashboard')
                                ? 'bg-indigo-50 text-indigo-700'
                                : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                    >
                        Dashboard
                    </a>


                    <!-- My Decks -->

                    <a
                        href="{{ route('decks.index') }}"
                        wire:navigate
                        @click="open = false"
                        class="flex items-center rounded-xl px-4 py-3 text-sm font-semibold transition
                            {{ request()->routeIs('decks.*')
                                ? 'bg-cyan-50 text-cyan-700'
                                : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                    >
                        My Decks
                    </a>

                @else

                    <!-- Home -->

                    <a
                        href="{{ url('/') }}"
                        wire:navigate
                        @click="open = false"
                        class="flex items-center rounded-xl px-4 py-3 text-sm font-semibold transition
                            {{ request()->is('/')
                                ? 'bg-indigo-50 text-indigo-700'
                                : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                    >
                        Home
                    </a>

                @endauth


                <!-- Browse Decks -->

                <a
                    href="{{ route('browse-decks') }}"
                    wire:navigate
                    @click="open = false"
                    class="flex items-center rounded-xl px-4 py-3 text-sm font-semibold transition
                        {{ request()->routeIs('browse-decks')
                            ? 'bg-indigo-50 text-indigo-700'
                            : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                >
                    Browse Decks
                </a>

            </div>


            @auth

                <!-- ================================================== -->
                <!-- ACCOUNT -->
                <!-- ================================================== -->

                <div class="my-5 border-t border-slate-200"></div>


                <div class="space-y-1">

                    <p class="px-4 pb-2 text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Account
                    </p>


                    <!-- User Information -->

                    <div class="mb-2 rounded-xl bg-slate-50 px-4 py-3">

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-gradient-to-br from-cyan-100 to-indigo-100 text-sm font-bold text-indigo-700"
                            >
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>

                            <div class="min-w-0">

                                <p class="truncate text-sm font-semibold text-slate-900">
                                    {{ auth()->user()->name }}
                                </p>

                                <p class="truncate text-xs text-slate-500">
                                    {{ auth()->user()->email }}
                                </p>

                            </div>

                        </div>

                    </div>


                    <!-- Profile -->

                    <a
                        href="{{ route('profile') }}"
                        wire:navigate
                        @click="open = false"
                        class="flex items-center rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-cyan-50 hover:text-cyan-700"
                    >
                        Profile
                    </a>


                    <!-- Log Out -->

                    <button
                        type="button"
                        wire:click="logout"
                        @click="open = false"
                        class="flex w-full items-center rounded-xl px-4 py-3 text-left text-sm font-semibold text-slate-600 transition hover:bg-red-50 hover:text-red-600"
                    >
                        Log Out
                    </button>

                </div>


            @else

                <!-- ================================================== -->
                <!-- GUEST ACCOUNT -->
                <!-- ================================================== -->

                <div class="mt-5 border-t border-slate-200 pt-4">

                    <div class="space-y-1">

                        <a
                            href="{{ route('login') }}"
                            wire:navigate
                            @click="open = false"
                            class="flex items-center rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                        >
                            Log In
                        </a>

                        <a
                            href="{{ route('register') }}"
                            wire:navigate
                            @click="open = false"
                            class="mt-2 flex items-center justify-center rounded-xl bg-gradient-to-r from-cyan-500 to-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm"
                        >
                            Get Started
                        </a>

                    </div>

                </div>

            @endauth

        </div>

    </div>

</nav>