<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:' . User::class,
            ],
            'password' => [
                'required',
                'string',
                'confirmed',
                Rules\Password::defaults(),
            ],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(
            new Registered(
                $user = User::create($validated)
            )
        );

        Auth::login($user);

        $this->redirect(
            route('dashboard', absolute: false),
            navigate: true
        );
    }
}; ?>


<div>

    <!-- Heading -->

    <div class="mb-8 text-center">

        <span
            class="inline-flex rounded-full bg-cyan-100 px-4 py-2 text-sm font-semibold text-cyan-700"
        >
            Get Started
        </span>

        <h1 class="mt-6 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
            Create your account
        </h1>

        <p class="mt-3 text-base leading-7 text-slate-600">
            Build your own study space and start creating flashcard decks.
        </p>

    </div>


    <!-- Card -->

    <div
        class="rounded-3xl border border-slate-200 bg-white/90 p-7 shadow-xl backdrop-blur sm:p-8"
    >

        <form wire:submit="register" class="space-y-5">


            <!-- Name -->

            <div>

                <x-input-label
                    for="name"
                    :value="__('Name')"
                    class="font-semibold text-slate-700"
                />

                <x-text-input
                    wire:model="name"
                    id="name"
                    class="mt-2 block w-full rounded-xl border-slate-200 bg-white px-4 py-3 shadow-sm transition focus:border-cyan-400 focus:ring-cyan-200"
                    type="text"
                    name="name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <x-input-error
                    :messages="$errors->get('name')"
                    class="mt-2"
                />

            </div>


            <!-- Email -->

            <div>

                <x-input-label
                    for="email"
                    :value="__('Email')"
                    class="font-semibold text-slate-700"
                />

                <x-text-input
                    wire:model="email"
                    id="email"
                    class="mt-2 block w-full rounded-xl border-slate-200 bg-white px-4 py-3 shadow-sm transition focus:border-cyan-400 focus:ring-cyan-200"
                    type="email"
                    name="email"
                    required
                    autocomplete="username"
                />

                <x-input-error
                    :messages="$errors->get('email')"
                    class="mt-2"
                />

            </div>


            <!-- Password -->

            <div>

                <x-input-label
                    for="password"
                    :value="__('Password')"
                    class="font-semibold text-slate-700"
                />

                <x-text-input
                    wire:model="password"
                    id="password"
                    class="mt-2 block w-full rounded-xl border-slate-200 bg-white px-4 py-3 shadow-sm transition focus:border-cyan-400 focus:ring-cyan-200"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                />

                <x-input-error
                    :messages="$errors->get('password')"
                    class="mt-2"
                />

            </div>


            <!-- Confirm Password -->

            <div>

                <x-input-label
                    for="password_confirmation"
                    :value="__('Confirm Password')"
                    class="font-semibold text-slate-700"
                />

                <x-text-input
                    wire:model="password_confirmation"
                    id="password_confirmation"
                    class="mt-2 block w-full rounded-xl border-slate-200 bg-white px-4 py-3 shadow-sm transition focus:border-cyan-400 focus:ring-cyan-200"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <x-input-error
                    :messages="$errors->get('password_confirmation')"
                    class="mt-2"
                />

            </div>


            <!-- Submit -->

            <button
                type="submit"
                class="mt-2 inline-flex w-full items-center justify-center rounded-xl bg-gradient-to-r from-cyan-500 to-indigo-600 px-5 py-3.5 text-sm font-semibold text-white shadow-sm transition duration-300 hover:-translate-y-0.5 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:ring-offset-2"
            >
                {{ __('Create Account') }}
            </button>

        </form>

    </div>


    <!-- Login -->

    <div class="mt-6 text-center">

        <p class="text-sm text-slate-500">

            Already have an account?

            <a
                href="{{ route('login') }}"
                wire:navigate
                class="font-semibold text-indigo-600 transition hover:text-indigo-800"
            >
                Log in
            </a>

        </p>

    </div>

</div>