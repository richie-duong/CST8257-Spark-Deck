<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(
            default: route('dashboard', absolute: false),
            navigate: true
        );
    }
}; ?>

<div>

    <!-- Heading -->

    <div class="mb-8 text-center">

        <span
            class="mt-5 inline-flex rounded-full bg-cyan-100 px-4 py-2 text-sm font-semibold text-cyan-700"
        >
            Your Study Space
        </span>

        <h1 class="mt-6 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
            Welcome back
        </h1>

        <p class="mt-3 text-base leading-7 text-slate-600">
            Sign in to continue building and studying your decks.
        </p>

    </div>


    <!-- Card -->

    <div
        class="rounded-3xl border border-slate-200 bg-white/90 p-7 shadow-xl backdrop-blur sm:p-8"
    >

        <!-- Session Status -->

        <x-auth-session-status
            class="mb-6"
            :status="session('status')"
        />


        <form wire:submit="login" class="space-y-5">


            <!-- Email -->

            <div>

                <x-input-label
                    for="email"
                    :value="__('Email')"
                    class="font-semibold text-slate-700"
                />

                <x-text-input
                    wire:model="form.email"
                    id="email"
                    class="mt-2 block w-full rounded-xl border-slate-200 bg-white px-4 py-3 shadow-sm transition focus:border-cyan-400 focus:ring-cyan-200"
                    type="email"
                    name="email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <x-input-error
                    :messages="$errors->get('form.email')"
                    class="mt-2"
                />

            </div>


            <!-- Password -->

            <div>

                <div class="flex items-center justify-between">

                    <x-input-label
                        for="password"
                        :value="__('Password')"
                        class="font-semibold text-slate-700"
                    />

                    @if (Route::has('password.request'))

                        <a
                            href="{{ route('password.request') }}"
                            wire:navigate
                            class="text-sm font-semibold text-indigo-600 transition hover:text-indigo-800"
                        >
                            Forgot password?
                        </a>

                    @endif

                </div>


                <x-text-input
                    wire:model="form.password"
                    id="password"
                    class="mt-2 block w-full rounded-xl border-slate-200 bg-white px-4 py-3 shadow-sm transition focus:border-cyan-400 focus:ring-cyan-200"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                />

                <x-input-error
                    :messages="$errors->get('form.password')"
                    class="mt-2"
                />

            </div>


            <!-- Remember Me -->

            <label
                for="remember"
                class="flex cursor-pointer items-center gap-3"
            >

                <input
                    wire:model="form.remember"
                    id="remember"
                    type="checkbox"
                    name="remember"
                    class="rounded border-slate-300 text-indigo-600 shadow-sm focus:ring-2 focus:ring-indigo-200"
                >

                <span class="text-sm text-slate-600">
                    {{ __('Remember me') }}
                </span>

            </label>


            <!-- Submit -->

            <button
                type="submit"
                class="mt-2 inline-flex w-full items-center justify-center rounded-xl bg-gradient-to-r from-cyan-500 to-indigo-600 px-5 py-3.5 text-sm font-semibold text-white shadow-sm transition duration-300 hover:-translate-y-0.5 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:ring-offset-2"
            >
                {{ __('Log in') }}
            </button>

        </form>

    </div>


    <!-- Register -->

    <div class="mt-6 text-center">

        <p class="text-sm text-slate-500">

            Don't have an account?

            <a
                href="{{ route('register') }}"
                wire:navigate
                class="font-semibold text-indigo-600 transition hover:text-indigo-800"
            >
                Create an account
            </a>

        </p>

    </div>

</div>