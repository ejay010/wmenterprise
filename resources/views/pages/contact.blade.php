<x-layouts::app.header>
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-sky-100 via-teal-50 to-blue-100 py-16 lg:py-20 overflow-hidden border-b border-zinc-200/60">
        <div class="absolute inset-0 z-0">
            <img src="{{ Vite::asset('resources/images/glass-window-bridge.jpg') }}"
                alt="Tropical coastline with turquoise water"
                class="w-full h-full object-cover object-center mix-blend-overlay opacity-50" />
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block text-xs font-extrabold uppercase tracking-widest text-[#ed6f7c] mb-3 bg-white/80 backdrop-blur-xs px-3.5 py-1 rounded-full shadow-xs">
                We're Here For You
            </span>
            <h1 class="text-4xl sm:text-5xl font-extrabold text-zinc-900 tracking-tight leading-[1.15] mb-4">
                Get in Touch
            </h1>
            <p class="text-base sm:text-lg text-zinc-700 max-w-xl mx-auto font-normal leading-relaxed">
                Have questions about airport pickup, rental rates, or vehicle availability? Reach out directly by phone, WhatsApp, or message below.
            </p>
        </div>
    </section>

    <!-- Main Contact Content & Form -->
    <section class="py-16 lg:py-20 bg-zinc-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                <!-- Left Column: Contact Cards & Details -->
                <div class="lg:col-span-5 space-y-6">
                    <div>
                        <span class="text-xs font-extrabold uppercase tracking-widest text-[#ed6f7c]">
                            Direct Communication
                        </span>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0a192f] tracking-tight mt-1 mb-3">
                            Connect With Our Island Team
                        </h2>
                        <p class="text-sm text-zinc-600 leading-relaxed">
                            For urgent pickup coordination or immediate questions, calling or messaging via WhatsApp is the quickest way to reach us.
                        </p>
                    </div>

                    <!-- Phone Card -->
                    <div class="bg-white p-6 rounded-2xl border border-zinc-200 shadow-xs flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-teal-50 text-[#007f8c] flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div>
                            <flux:heading size="base" class="text-zinc-900 font-bold mb-0.5">Phone Support</flux:heading>
                            <p class="text-xs text-zinc-500 mb-2">Direct call for reservations and dispatch</p>
                            <a href="tel:242-376-1454" class="text-sm font-bold text-accent hover:underline">
                                (242) 376-1454
                            </a>
                        </div>
                    </div>

                    <!-- WhatsApp Card -->
                    <div class="bg-white p-6 rounded-2xl border border-zinc-200 shadow-xs flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                            </svg>
                        </div>
                        <div>
                            <flux:heading size="base" class="text-zinc-900 font-bold mb-0.5">WhatsApp Messenger</flux:heading>
                            <p class="text-xs text-zinc-500 mb-2">Instant messaging & flight coordinate updates</p>
                            <a href="https://wa.me/12423761454" target="_blank" class="text-sm font-bold text-emerald-600 hover:underline">
                                Message on WhatsApp
                            </a>
                        </div>
                    </div>

                    <!-- Locations Card -->
                    <div class="bg-white p-6 rounded-2xl border border-zinc-200 shadow-xs flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-sky-50 text-sky-700 flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <flux:heading size="base" class="text-zinc-900 font-bold mb-0.5">Pick-up & Drop-off Hubs</flux:heading>
                            <p class="text-xs text-zinc-500 mb-2">Rock Sound, Eleuthera, Bahamas</p>
                            <ul class="text-xs text-zinc-700 space-y-1 font-medium">
                                <li>• Rock Sound International Airport (RSD)</li>
                                <li>• Governor's Harbour International Airport (GHB)</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Livewire Contact Inquiry Form -->
                <div class="lg:col-span-7">
                    <livewire:client.contact-form />
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('partials.footer')
</x-layouts::app.header>
