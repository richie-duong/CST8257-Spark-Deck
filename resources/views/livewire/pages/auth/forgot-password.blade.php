<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<div>

    <!-- Heading -->

    <div class="mb-8 text-center">

        <span
            class="inline-flex rounded-full bg-cyan-100 px-4 py-2 text-sm font-semibold text-cyan-700"
        >
            Account Recovery
        </span>

        <h1 class="mt-6 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
            Forgot your password?
        </h1>

        <p class="mt-3 text-base leading-7 text-slate-600">
            No worries. Enter your email and we'll send you a link to reset your password.
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


        <form wire:submit="sendPasswordResetLink" class="space-y-5">

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
                    autofocus
                    autocomplete="email"
                    placeholder="you@example.com"
                />

                <x-input-error
                    :messages="$errors->get('email')"
                    class="mt-2"
                />

            </div>


            <!-- Submit -->

            <button
                type="submit"
                class="mt-2 inline-flex w-full items-center justify-center rounded-xl bg-gradient-to-r from-cyan-500 to-indigo-600 px-5 py-3.5 text-sm font-semibold text-white shadow-sm transition duration-300 hover:-translate-y-0.5 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:ring-offset-2"
            >
                {{ __('Email Password Reset Link') }}
            </button>

        </form>

    </div>


    <!-- Back to Login -->

    <div class="mt-6 text-center">

        <a
            href="{{ route('login') }}"
            wire:navigate
            class="inline-flex items-center text-sm font-semibold text-indigo-600 transition hover:text-indigo-800"
        >
            ← Back to Log in
        </a>

    </div>

</div>