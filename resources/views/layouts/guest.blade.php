<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Spark Deck</title>

    <link
        rel="icon"
        type="image/svg+xml"
        href="{{ asset('images/spark-deck-logo-narrow.svg') }}"
    >

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap"
        rel="stylesheet"
    />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="min-h-screen bg-slate-50 font-sans text-slate-900 antialiased">

    <!-- Background -->

    <div class="pointer-events-none fixed inset-0 overflow-hidden">

        <!-- Cyan glow -->

        <div
            class="absolute -left-32 -top-32 h-[500px] w-[500px] rounded-full bg-cyan-200/40 blur-3xl"
        ></div>

        <!-- Indigo glow -->

        <div
            class="absolute -right-32 top-1/4 h-[600px] w-[600px] rounded-full bg-indigo-200/40 blur-3xl"
        ></div>

        <!-- Bottom glow -->

        <div
            class="absolute bottom-[-250px] left-1/3 h-[500px] w-[500px] rounded-full bg-cyan-100/30 blur-3xl"
        ></div>

    </div>


    <!-- Main -->

    <div class="relative flex min-h-screen flex-col">


        <!-- Header -->

        <header class="px-6 pt-8 sm:px-8">

            <div class="mx-auto flex max-w-5xl items-center justify-between">

                <!-- Brand -->

                <a
                    href="/"
                    wire:navigate
                    class="group flex items-center gap-3"
                >

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-cyan-100 to-indigo-100 shadow-sm transition duration-300 group-hover:-translate-y-0.5 group-hover:shadow-md"
                    >
                        <img
                            src="{{ asset('images/spark-deck-logo-narrow.svg') }}"
                            alt="SparkDeck"
                            class="h-7 w-auto"
                        />
                    </div>

                    <span class="text-lg font-bold tracking-tight text-slate-900">
                        Spark<span class="text-indigo-600">Deck</span>
                    </span>

                </a>


                <!-- Back to site -->

                <a
                    href="/"
                    wire:navigate
                    class="hidden text-sm font-semibold text-slate-500 transition hover:text-indigo-600 sm:inline-flex"
                >
                    Back to Spark Deck
                </a>

            </div>

        </header>


        <!-- Content -->

        <main class="flex flex-1 items-center justify-center px-4 py-12 sm:px-6 sm:py-16">

            <div class="w-full sm:max-w-md">

                {{ $slot }}

            </div>

        </main>


        <!-- Footer -->

        <footer class="px-6 pb-8 text-center">

            <p class="text-xs text-slate-400">
                Spark Deck · Your study space
            </p>

        </footer>

    </div>

</body>

</html>