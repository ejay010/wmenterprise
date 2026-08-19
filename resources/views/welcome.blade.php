<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800 antialiased">
    <flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:brand href="#" logo="{{ Vite::asset('resources/images/logo.png') }}" name="W Major Enterprises" />
        <flux:navbar class="-mb-px max-lg:hidden">
            <flux:navbar.item>Sign in</flux:navbar.item>
        </flux:navbar>
    </flux:header>

    <section id="hero" class="relative overflow-hidden">
        <div class="relative isolate px-6 lg:px-8">
            <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
                <div class="hidden sm:mb-8 sm:flex sm:justify-center">
                    <div
                        class="relative rounded-full px-3 py-1 text-sm leading-6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
                        Executive Car Rental
                    </div>
                </div>
                <div class="text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-accent sm:text-6xl">
                        Rent a vehicle for your next trip to Eleuthera
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-gray-600">
                        Book your next vehicle rental with W Major Enterprises. We offer a wide range of vehicles to
                        suit
                        your needs.
                        View our catalog, find a vehicle that you like and book it for your next trip. Simple and
                        reliable. Contact us at 376-1454
                    </p>
                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        <a href="{{ route('catalog') }}"
                            class="rounded-md bg-accent px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-accent/80 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent">Browse
                            Vehicles</a>
                        <a href="tel:242-376-1454" class="text-sm font-semibold leading-6 text-gray-900">Call Us: <span
                                aria-hidden="true">→</span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @fluxScripts
</body>

</html>
