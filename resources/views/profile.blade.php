<x-app-layout>

    <section class="relative min-h-screen overflow-hidden bg-gradient-to-br from-cyan-50 via-white to-indigo-50 py-16">

        <!-- Background Glows -->
        <div class="pointer-events-none absolute -left-24 top-12 h-80 w-80 rounded-full bg-cyan-200/30 blur-3xl"></div>
        <div class="pointer-events-none absolute right-0 top-0 h-96 w-96 rounded-full bg-indigo-200/30 blur-3xl"></div>
        <div class="pointer-events-none absolute bottom-[-200px] left-1/3 h-96 w-96 rounded-full bg-cyan-100/30 blur-3xl"></div>


        <div class="relative mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

            <!-- Page Header -->
            <div>

                <span class="inline-flex rounded-full bg-cyan-100 px-4 py-2 text-sm font-semibold text-cyan-700">
                    Account Settings
                </span>

                <h1 class="mt-6 text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">
                    Your Profile
                </h1>

                <p class="mt-3 max-w-2xl text-lg leading-8 text-slate-600">
                    Update your personal details, password, and account preferences.
                </p>

            </div>


            <!-- Profile Forms -->
            <div class="mt-10 space-y-6">

                <!-- Personal Information -->
                <div class="rounded-3xl border border-slate-200 bg-white/90 p-6 shadow-lg backdrop-blur sm:p-8">

                    <div class="max-w-xl">
                        <livewire:profile.update-profile-information-form />
                    </div>

                </div>


                <!-- Password -->
                <div class="rounded-3xl border border-slate-200 bg-white/90 p-6 shadow-lg backdrop-blur sm:p-8">

                    <div class="max-w-xl">
                        <livewire:profile.update-password-form />
                    </div>

                </div>


                <!-- Delete Account -->
                <div class="rounded-3xl border border-red-100 bg-white/90 p-6 shadow-lg backdrop-blur sm:p-8">

                    <div class="max-w-xl">
                        <livewire:profile.delete-user-form />
                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- Back to Top Button -->
    <button
        x-data="{ show: false }"
        x-show="show"
        x-transition
        @scroll.window="show = window.scrollY > 300"
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="fixed bottom-6 right-6 z-50 flex h-12 w-12 items-center justify-center rounded-full bg-indigo-600 text-white shadow-lg transition hover:-translate-y-1 hover:bg-indigo-700 hover:shadow-xl"
        aria-label="Back to top"
    >
        ↑
    </button>


    <!-- SparkDeck Button Styling -->
    <style>
        /* Primary profile buttons */
        form button[type="submit"] {
            border-radius: 0.75rem !important;
            background: linear-gradient(to right, #06b6d4, #4f46e5) !important;
            color: white !important;
            font-weight: 600 !important;
            padding: 0.75rem 1.25rem !important;
            border: none !important;
            box-shadow: 0 1px 2px rgb(0 0 0 / 0.05);
            transition: all 0.3s ease;
        }

        form button[type="submit"]:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgb(79 70 229 / 0.18);
        }

        form button[type="submit"]:focus {
            outline: none;
            box-shadow:
                0 0 0 2px white,
                0 0 0 4px rgb(99 102 241 / 0.35);
        }

        /* Delete button */
        form button[type="submit"].text-red-600,
        form button[type="submit"][class*="red"] {
            background: rgb(254 242 242) !important;
            color: rgb(185 28 28) !important;
            box-shadow: none;
        }

        form button[type="submit"].text-red-600:hover,
        form button[type="submit"][class*="red"]:hover {
            background: rgb(254 226 226) !important;
            transform: translateY(-1px);
        }
    </style>

</x-app-layout>