<x-app-layout>
    <section class="relative overflow-hidden bg-gradient-to-br from-cyan-50 via-white to-indigo-50 py-16">
        <div class="absolute -left-24 top-12 h-80 w-80 rounded-full bg-cyan-200/30 blur-3xl"></div>
        <div class="absolute right-0 top-0 h-96 w-96 rounded-full bg-indigo-200/30 blur-3xl"></div>

        <div class="relative mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <span class="inline-flex rounded-full bg-cyan-100 px-4 py-2 text-sm font-semibold text-cyan-700">
                Account Settings
            </span>

            <h1 class="mt-6 text-4xl font-bold tracking-tight text-slate-900">Your Profile</h1>
            <p class="mt-3 text-lg text-slate-600">Update your personal details, password, and account preferences.</p>

            <div class="mt-10 space-y-6">
                <div class="rounded-3xl border border-slate-200 bg-white/90 p-6 shadow-lg sm:p-8">
                    <div class="max-w-xl">
                        <livewire:profile.update-profile-information-form />
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white/90 p-6 shadow-lg sm:p-8">
                    <div class="max-w-xl">
                        <livewire:profile.update-password-form />
                    </div>
                </div>

                <div class="rounded-3xl border border-red-100 bg-white/90 p-6 shadow-lg sm:p-8">
                    <div class="max-w-xl">
                        <livewire:profile.delete-user-form />
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
