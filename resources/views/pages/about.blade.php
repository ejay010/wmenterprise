<x-layouts::app.header>
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-sky-100 via-teal-50 to-blue-100 py-16 lg:py-24 overflow-hidden border-b border-zinc-200/60">
        <div class="absolute inset-0 z-0">
            <img src="{{ Vite::asset('resources/images/glass-window-bridge.jpg') }}"
                alt="Tropical coastline with turquoise water"
                class="w-full h-full object-cover object-center mix-blend-overlay opacity-50" />
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block text-xs font-extrabold uppercase tracking-widest text-[#ed6f7c] mb-3 bg-white/80 backdrop-blur-xs px-3.5 py-1 rounded-full shadow-xs">
                Rooted in Eleuthera
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-zinc-900 tracking-tight leading-[1.15] mb-4">
                About W Major Enterprises
            </h1>
            <p class="text-base sm:text-lg text-zinc-700 max-w-2xl mx-auto font-normal leading-relaxed">
                Locally owned, island-operated, and dedicated to delivering a seamless, stress-free car rental experience across beautiful Eleuthera.
            </p>
        </div>
    </section>

    <!-- Our Story & Mission -->
    <section class="py-16 lg:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Story Description -->
                <div class="lg:col-span-7 space-y-6">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-[#ed6f7c]">
                        Our Story & Passion
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-[#0a192f] tracking-tight">
                        Explore Eleuthera with Confidence & Comfort
                    </h2>
                    <p class="text-sm sm:text-base text-zinc-600 leading-relaxed">
                        Welcome to <strong>W Major Enterprises Car Rental</strong>, based in Rock Sound, Eleuthera. We founded our rental business with one clear mission: to make exploring our slender 110-mile island as effortless, safe, and enjoyable as possible for travelers, vacationers, and locals alike.
                    </p>
                    <p class="text-sm sm:text-base text-zinc-600 leading-relaxed">
                        Whether you are landing at <strong>Rock Sound International Airport (RSD)</strong> or <strong>Governor's Harbour International Airport (GHB)</strong>, we ensure your vehicle is waiting, thoroughly inspected, and ready to take you from the pink sand beaches in the north to the quiet settlements and surf spots in the south.
                    </p>

                    <div class="pt-2 flex flex-wrap gap-4">
                        <a href="{{ route('catalog') }}" wire:navigate
                            class="inline-flex items-center gap-2 bg-accent text-white font-semibold text-sm px-6 py-3 rounded-xl shadow-sm hover:shadow-md transition transform hover:-translate-y-0.5">
                            <span>Browse Vehicle Fleet</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                        <a href="{{ route('contact') }}" wire:navigate
                            class="inline-flex items-center gap-2 bg-zinc-100 hover:bg-zinc-200 text-zinc-800 font-semibold text-sm px-6 py-3 rounded-xl transition">
                            <span>Contact Our Team</span>
                        </a>
                    </div>
                </div>

                <!-- Feature Highlights Cards -->
                <div class="lg:col-span-5 space-y-4">
                    <flux:card class="p-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-teal-50 text-[#007f8c] flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <flux:heading size="base" class="text-zinc-900 font-bold mb-1">Direct Airport Delivery</flux:heading>
                                <p class="text-xs text-zinc-500 leading-relaxed">
                                    Hassle-free meet-and-greet drop-offs directly at Rock Sound & Governor's Harbour airports.
                                </p>
                            </div>
                        </div>
                    </flux:card>

                    <flux:card class="p-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-sky-50 text-sky-700 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <div>
                                <flux:heading size="base" class="text-zinc-900 font-bold mb-1">Clean & Smoke-Free Fleet</flux:heading>
                                <p class="text-xs text-zinc-500 leading-relaxed">
                                    Strictly maintained, 100% smoke-free cars, SUVs, and vans with full safety checks before every rental.
                                </p>
                            </div>
                        </div>
                    </flux:card>

                    <flux:card class="p-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <flux:heading size="base" class="text-zinc-900 font-bold mb-1">Clear & Honest Pricing</flux:heading>
                                <p class="text-xs text-zinc-500 leading-relaxed">
                                    Transparent daily rates, straightforward agreements, and zero surprise hidden fees.
                                </p>
                            </div>
                        </div>
                    </flux:card>
                </div>

            </div>
        </div>
    </section>

    <!-- Why Choose Us Grid -->
    <section class="py-16 lg:py-20 bg-zinc-50 border-t border-zinc-200/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12 space-y-2">
                <span class="text-xs font-extrabold uppercase tracking-widest text-[#ed6f7c]">OUR COMMITMENT</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#0a192f] tracking-tight">
                    The W Major Difference
                </h2>
                <p class="text-sm sm:text-base text-zinc-500">
                    We combine friendly island service with modern, dependable vehicles.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Point 1 -->
                <div class="bg-white p-8 rounded-2xl border border-zinc-200/80 shadow-xs space-y-3">
                    <div class="w-12 h-12 rounded-xl bg-teal-50 text-[#007f8c] flex items-center justify-center font-bold text-lg">
                        01
                    </div>
                    <flux:heading size="lg" class="text-zinc-900 font-bold">Local Island Knowledge</flux:heading>
                    <p class="text-xs sm:text-sm text-zinc-600 leading-relaxed">
                        Born and raised in Eleuthera, our team knows every beach, graded side road, and hidden gem. We are always glad to recommend local spots.
                    </p>
                </div>

                <!-- Point 2 -->
                <div class="bg-white p-8 rounded-2xl border border-zinc-200/80 shadow-xs space-y-3">
                    <div class="w-12 h-12 rounded-xl bg-teal-50 text-[#007f8c] flex items-center justify-center font-bold text-lg">
                        02
                    </div>
                    <flux:heading size="lg" class="text-zinc-900 font-bold">Flight-Synced Flexibility</flux:heading>
                    <p class="text-xs sm:text-sm text-zinc-600 leading-relaxed">
                        Island flights can change. We monitor your flight status and adjust our airport pickup schedule so you are never left waiting.
                    </p>
                </div>

                <!-- Point 3 -->
                <div class="bg-white p-8 rounded-2xl border border-zinc-200/80 shadow-xs space-y-3">
                    <div class="w-12 h-12 rounded-xl bg-teal-50 text-[#007f8c] flex items-center justify-center font-bold text-lg">
                        03
                    </div>
                    <flux:heading size="lg" class="text-zinc-900 font-bold">Digital & Seamless</flux:heading>
                    <p class="text-xs sm:text-sm text-zinc-600 leading-relaxed">
                        Reserve online, electronically sign your rental agreement in seconds, and receive an instant PDF copy straight to your email.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Banner -->
    <section class="py-16 bg-white border-t border-zinc-200/60">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#0a192f] tracking-tight">
                Ready to Experience Eleuthera?
            </h2>
            <p class="text-sm sm:text-base text-zinc-600 max-w-xl mx-auto">
                Select your travel dates, choose your ideal car or SUV, and lock in your reservation with W Major Enterprises today.
            </p>
            <div class="pt-2">
                <a href="{{ route('catalog') }}" wire:navigate
                    class="inline-flex items-center gap-2 bg-accent text-white font-bold text-sm sm:text-base px-8 py-3.5 rounded-xl shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5">
                    <span>View Available Vehicles</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('partials.footer')
</x-layouts::app.header>
