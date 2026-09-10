<x-layouts::app.header>
    <!-- ========================================== -->
    <!-- 2. HERO SECTION                           -->
    <!-- ========================================== -->
    <section
        class="relative bg-gradient-to-r from-sky-100 via-teal-50 to-blue-100 pt-16 pb-36 lg:pt-24 lg:pb-48 overflow-hidden">

        <!-- Tropical Coastline & Road Background Image Layer -->
        <div class="absolute inset-0 z-0">
            <img src="{{ Vite::asset('resources/images/glass-window-bridge.jpg') }}"
                alt="Tropical coastline with turquoise water"
                class="w-full h-full object-cover object-center mix-blend-overlay" />
            <div class=""></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

                <!-- Left Hero Content -->
                <div class="lg:col-span-6 space-y-6 text-center lg:text-left">
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-[1.15]">
                        Explore More.<br>
                        <span class="text-white">Worry Less.</span>
                    </h1>

                    <p class="text-base sm:text-lg text-white max-w-xl mx-auto lg:mx-0 font-normal leading-relaxed">
                        Reliable rental cars. Friendly service. Unforgettable journeys across the beautiful islands.
                    </p>

                    <div class="pt-2 flex justify-center lg:justify-start">
                        <a href="{{ route('catalog') }}" wire:navigate
                            class="inline-flex items-center gap-2 bg-accent text-white font-semibold text-sm sm:text-base px-7 py-3.5 rounded-lg shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5">
                            <span>Book Now</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ========================================== -->
    <!-- 3. FLOATING BOOKING & SEARCH WIDGET       -->
    <!-- ========================================== -->
    <div class="relative z-30 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 sm:-mt-24">
        <div class="bg-white rounded-2xl shadow-xl border border-zinc-100 p-4 sm:p-6 lg:p-7">
            <form action="{{ route('catalog') }}" method="GET"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4 items-end">

                <!-- 1. Pick-up Location -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-zinc-500 uppercase tracking-wider">Pick-up
                        Location</label>
                    <div class="relative flex items-center">
                        <svg class="w-4 h-4 text-zinc-400 absolute left-3 pointer-events-none" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <select name="location"
                            class="w-full pl-9 pr-7 py-2.5 text-xs sm:text-sm font-medium text-zinc-800 bg-zinc-50 hover:bg-zinc-100/80 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-[#007f8c] focus:outline-none appearance-none transition">
                            <option value="Rock Sound International Airport">Rock Sound, Eleuthera</option>
                            <option value="Governor's Harbour International Airport">Governor's Harbour, Eleuthera
                            </option>
                        </select>
                        <svg class="w-3.5 h-3.5 text-zinc-400 absolute right-2.5 pointer-events-none" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>

                <!-- 2. Pick-up Date -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-zinc-500 uppercase tracking-wider">Pick-up
                        Date</label>
                    <div class="relative flex items-center">
                        <svg class="w-4 h-4 text-zinc-400 absolute left-3 pointer-events-none" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <input type="date" name="pickup_date" value="{{ date('Y-m-d', strtotime('+1 day')) }}"
                            min="{{ date('Y-m-d') }}"
                            class="w-full pl-9 pr-3 py-2.5 text-xs sm:text-sm font-medium text-zinc-800 bg-zinc-50 hover:bg-zinc-100/80 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-[#007f8c] focus:outline-none transition" />
                    </div>
                </div>

                <!-- 3. Pick-up Time -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-zinc-500 uppercase tracking-wider">Pick-up
                        Time</label>
                    <div class="relative flex items-center">
                        <svg class="w-4 h-4 text-zinc-400 absolute left-3 pointer-events-none" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <select name="pickup_time"
                            class="w-full pl-9 pr-7 py-2.5 text-xs sm:text-sm font-medium text-zinc-800 bg-zinc-50 hover:bg-zinc-100/80 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-[#007f8c] focus:outline-none appearance-none transition">
                            <option value="09:00 AM">09:00 AM</option>
                            <option value="10:00 AM" selected>10:00 AM</option>
                            <option value="11:00 AM">11:00 AM</option>
                            <option value="12:00 PM">12:00 PM</option>
                            <option value="02:00 PM">02:00 PM</option>
                            <option value="04:00 PM">04:00 PM</option>
                        </select>
                        <svg class="w-3.5 h-3.5 text-zinc-400 absolute right-2.5 pointer-events-none" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>

                <!-- 4. Return Date -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-zinc-500 uppercase tracking-wider">Return
                        Date</label>
                    <div class="relative flex items-center">
                        <svg class="w-4 h-4 text-zinc-400 absolute left-3 pointer-events-none" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <input type="date" name="return_date" value="{{ date('Y-m-d', strtotime('+4 days')) }}"
                            min="{{ date('Y-m-d') }}"
                            class="w-full pl-9 pr-3 py-2.5 text-xs sm:text-sm font-medium text-zinc-800 bg-zinc-50 hover:bg-zinc-100/80 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-[#007f8c] focus:outline-none transition" />
                    </div>
                </div>

                <!-- 5. Return Time -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-zinc-500 uppercase tracking-wider">Return
                        Time</label>
                    <div class="relative flex items-center">
                        <svg class="w-4 h-4 text-zinc-400 absolute left-3 pointer-events-none" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <select name="return_time"
                            class="w-full pl-9 pr-7 py-2.5 text-xs sm:text-sm font-medium text-zinc-800 bg-zinc-50 hover:bg-zinc-100/80 border border-zinc-200 rounded-xl focus:ring-2 focus:ring-[#007f8c] focus:outline-none appearance-none transition">
                            <option value="09:00 AM">09:00 AM</option>
                            <option value="10:00 AM" selected>10:00 AM</option>
                            <option value="11:00 AM">11:00 AM</option>
                            <option value="12:00 PM">12:00 PM</option>
                            <option value="02:00 PM">02:00 PM</option>
                            <option value="04:00 PM">04:00 PM</option>
                        </select>
                        <svg class="w-3.5 h-3.5 text-zinc-400 absolute right-2.5 pointer-events-none" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>

                <!-- 6. Search CTA Button -->
                <div>
                    <button type="submit"
                        class="w-full bg-accent text-white font-bold text-sm py-3 px-4 rounded-xl shadow hover:shadow-md transition flex items-center justify-center gap-1.5">
                        <span>Find My Car</span>
                    </button>
                </div>

            </form>
        </div>
    </div>


    <!-- ========================================== -->
    <!-- 4. VALUE PROPOSITIONS / FEATURES SECTION  -->
    <!-- ========================================== -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">

                <!-- Feature 1: Reliable & Safe -->
                <div class="text-center space-y-3">
                    <div
                        class="w-16 h-16 mx-auto rounded-full bg-zinc-50 border border-zinc-200 flex items-center justify-center shadow-xs">
                        <svg class="w-7 h-7 text-[#0a192f]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-base text-[#0a192f]">Reliable & Safe</h3>
                    <p class="text-xs text-zinc-500 leading-relaxed max-w-xs mx-auto">
                        Well-maintained vehicles for a worry-free ride across the islands.
                    </p>
                </div>

                <!-- Feature 2: Convenient Locations -->
                <div class="text-center space-y-3">
                    <div
                        class="w-16 h-16 mx-auto rounded-full bg-zinc-50 border border-zinc-200 flex items-center justify-center shadow-xs">
                        <svg class="w-7 h-7 text-[#0a192f]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-base text-[#0a192f]">Convenient Locations</h3>
                    <p class="text-xs text-zinc-500 leading-relaxed max-w-xs mx-auto">
                        Pick up and drop off where it's easiest for you at major island hubs.
                    </p>
                </div>

                <!-- Feature 3: Best Rates -->
                <div class="text-center space-y-3">
                    <div
                        class="w-16 h-16 mx-auto rounded-full bg-zinc-50 border border-zinc-200 flex items-center justify-center shadow-xs">
                        <svg class="w-7 h-7 text-[#0a192f]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-base text-[#0a192f]">Best Rates</h3>
                    <p class="text-xs text-zinc-500 leading-relaxed max-w-xs mx-auto">
                        Competitive, transparent prices with no hidden fees or surprises.
                    </p>
                </div>

                <!-- Feature 4: 24/7 Support -->
                <div class="text-center space-y-3">
                    <div
                        class="w-16 h-16 mx-auto rounded-full bg-zinc-50 border border-zinc-200 flex items-center justify-center shadow-xs">
                        <svg class="w-7 h-7 text-[#0a192f]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-base text-[#0a192f]">24/7 Support</h3>
                    <p class="text-xs text-zinc-500 leading-relaxed max-w-xs mx-auto">
                        We're here whenever you need us, day or night during your journey.
                    </p>
                </div>

            </div>
        </div>
    </section>


    <!-- ========================================== -->
    <!-- 5. VEHICLES SHOWCASE SECTION ("OUR VEHICLES") -->
    <!-- ========================================== -->
    <section id="vehicles" class="py-20 bg-zinc-50/70 border-t border-zinc-200/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto mb-14 space-y-2">
                <span class="text-xs font-extrabold uppercase tracking-widest text-[#ed6f7c]">OUR VEHICLES</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#0a192f] tracking-tight">Find the Perfect Ride
                </h2>
                <p class="text-sm sm:text-base text-zinc-500 font-normal">
                    From compact cars to spacious SUVs, we have the right vehicle for every journey and budget.
                </p>
            </div>

            <!-- Vehicle Carousel / Grid with Left & Right Arrows -->
            <div class="relative" x-data="{
                scrollLeft() { $refs.slider.scrollBy({ left: -320, behavior: 'smooth' }); },
                    scrollRight() { $refs.slider.scrollBy({ left: 320, behavior: 'smooth' }); }
            }">

                <!-- Left Navigation Arrow -->
                <button @click="scrollLeft()"
                    class="hidden md:flex absolute -left-5 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-[#007f8c] text-white items-center justify-center shadow-lg hover:bg-[#006873] transition focus:outline-none cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <!-- Right Navigation Arrow -->
                <button @click="scrollRight()"
                    class="hidden md:flex absolute -right-5 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-[#007f8c] text-white items-center justify-center shadow-lg hover:bg-[#006873] transition focus:outline-none cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <!-- Slider Container (4 Column Grid on Desktop, Horizontal Scroll on Mobile) -->
                <div x-ref="slider"
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 overflow-x-auto pb-4 scroll-smooth">

                    <!-- Vehicle Card 1: Economy -->
                    @foreach ($vehicles as $vehicle)
                        <a href="{{ route('vehicle.show', ['vehicle' => $vehicle]) }}" wire:navigate>
                            <flux:card class="p-0 overflow-hidden flex flex-col">
                                <div class=" overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1550355291-bbee04a92027?auto=format&fit=crop&w=600&q=80"
                                        alt="Economy Car"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                                </div>
                            </flux:card>
                        </a>
                    @endforeach

                    {{-- <!-- Vehicle Card 2: Midsize -->
                    <div
                        class="bg-white rounded-2xl border border-zinc-200/80 overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 flex flex-col group">
                        <div class="aspect-4/3 relative overflow-hidden bg-zinc-100">
                            <img src="https://images.unsplash.com/photo-1550355291-bbee04a92027?auto=format&fit=crop&w=600&q=80"
                                alt="Midsize Sedan"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                        </div>
                        <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                            <div class="flex items-center justify-between">
                                <h3 class="font-bold text-lg text-[#0a192f]">Midsize</h3>
                                <div class="text-right">
                                    <span class="text-xs text-zinc-400 font-medium">From </span>
                                    <span class="text-sm font-extrabold text-[#007f8c]">$60</span>
                                    <span class="text-xs text-zinc-400"> / day</span>
                                </div>
                            </div>
                            <div
                                class="pt-3 border-t border-zinc-100 flex items-center justify-between text-[11px] text-zinc-500 font-medium">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-zinc-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span>5 Seats</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-zinc-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                    <span>2 Bags</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-zinc-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>Auto</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Vehicle Card 3: SUV -->
                    <div
                        class="bg-white rounded-2xl border border-zinc-200/80 overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 flex flex-col group">
                        <div class="aspect-4/3 relative overflow-hidden bg-zinc-100">
                            <img src="https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?auto=format&fit=crop&w=600&q=80"
                                alt="SUV"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                        </div>
                        <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                            <div class="flex items-center justify-between">
                                <h3 class="font-bold text-lg text-[#0a192f]">SUV</h3>
                                <div class="text-right">
                                    <span class="text-xs text-zinc-400 font-medium">From </span>
                                    <span class="text-sm font-extrabold text-[#007f8c]">$85</span>
                                    <span class="text-xs text-zinc-400"> / day</span>
                                </div>
                            </div>
                            <div
                                class="pt-3 border-t border-zinc-100 flex items-center justify-between text-[11px] text-zinc-500 font-medium">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-zinc-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span>7 Seats</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-zinc-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                    <span>3 Bags</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-zinc-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>Auto</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Vehicle Card 4: Van -->
                    <div
                        class="bg-white rounded-2xl border border-zinc-200/80 overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 flex flex-col group">
                        <div class="aspect-4/3 relative overflow-hidden bg-zinc-100">
                            <img src="https://images.unsplash.com/photo-1563720223185-11003d516935?auto=format&fit=crop&w=600&q=80"
                                alt="Passenger Van"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                        </div>
                        <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                            <div class="flex items-center justify-between">
                                <h3 class="font-bold text-lg text-[#0a192f]">Van</h3>
                                <div class="text-right">
                                    <span class="text-xs text-zinc-400 font-medium">From </span>
                                    <span class="text-sm font-extrabold text-[#007f8c]">$110</span>
                                    <span class="text-xs text-zinc-400"> / day</span>
                                </div>
                            </div>
                            <div
                                class="pt-3 border-t border-zinc-100 flex items-center justify-between text-[11px] text-zinc-500 font-medium">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-zinc-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span>12 Seats</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-zinc-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                    <span>4 Bags</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-zinc-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>Auto</span>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                </div>

            </div>

        </div>
    </section>


    <!-- ========================================== -->
    <!-- 6. CALL TO ACTION PANORAMIC BANNER        -->
    <!-- ========================================== -->
    {{-- <section class="relative py-20 sm:py-24 bg-zinc-900 overflow-hidden">
        <!-- Panoramic Coastal Highway Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?auto=format&fit=crop&w=2000&q=80"
                alt="Scenic island coastal road"
                class="w-full h-full object-cover object-center opacity-45 mix-blend-overlay" />
            <div class="absolute inset-0 bg-gradient-to-r from-[#005f6b]/90 via-[#007f8c]/75 to-transparent"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-xl space-y-4 text-left">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight leading-tight">
                    Ready to hit the road?
                </h2>
                <p class="text-sm sm:text-base text-zinc-100 font-normal leading-relaxed">
                    Book now and enjoy a smooth, simple, and stress-free rental experience across the islands.
                </p>
                <div class="pt-2">
                    <a href="{{ route('catalog') }}" wire:navigate
                        class="inline-flex items-center gap-2 bg-white text-[#0a192f] hover:bg-zinc-100 font-bold text-sm px-6 py-3 rounded-xl shadow-md transition transform hover:-translate-y-0.5">
                        <span>Book Your Car</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section> --}}


    <!-- ========================================== -->
    <!-- 7. FOOTER SECTION                         -->
    <!-- ========================================== -->
    <footer class="bg-[#387024] text-zinc-300 pt-16 pb-12 border-t border-zinc-800" id="contact">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8 mb-16">

                <!-- Column 1: Brand & Socials (4 cols) -->
                <div class="lg:col-span-4 space-y-5">
                    <img src="{{ Vite::asset('resources/images/logo.png') }}" class="rounded w-32"
                        alt="W Major Enterprises">
                    <flux:heading size="xl" class="text-accent">W Major Enterprises</flux:heading>

                    <p class="text-xs text-white max-w-sm leading-relaxed">
                        Your adventure starts here. Quality cars. Great prices. Island experiences you'll cherish
                        forever.
                    </p>

                    <!-- Social Icons -->
                    <div class="flex items-center space-x-3 pt-2">
                        <!-- Facebook -->
                        <a href="#"
                            class="w-8 h-8 rounded-full bg-zinc-800/80 hover:bg-[#ed6f7c] text-white flex items-center justify-center transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" />
                            </svg>
                        </a>
                        <!-- Instagram -->
                        <a href="#"
                            class="w-8 h-8 rounded-full bg-zinc-800/80 hover:bg-[#ed6f7c] text-white flex items-center justify-center transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                        <!-- TikTok -->
                        <a href="#"
                            class="w-8 h-8 rounded-full bg-zinc-800/80 hover:bg-[#ed6f7c] text-white flex items-center justify-center transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1.04-.1z" />
                            </svg>
                        </a>
                        <!-- WhatsApp -->
                        <a href="https://wa.me/12423761454" target="_blank"
                            class="w-8 h-8 rounded-full bg-zinc-800/80 hover:bg-[#ed6f7c] text-white flex items-center justify-center transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Column 2: Quick Links (2 cols) -->
                <div class="lg:col-span-2 space-y-4">
                    <h4 class="font-bold text-sm text-white uppercase tracking-wider">Quick Links</h4>
                    <ul class="space-y-2.5 text-xs text-white">
                        <li><a href="{{ route('catalog') }}" class="hover:text-[#ed6f7c] transition"
                                wire:navigate>Vehicles</a></li>
                        <li><a href="#about" class="hover:text-[#ed6f7c] transition">About Us</a></li>
                        <li><a href="#contact" class="hover:text-[#ed6f7c] transition">Contact</a></li>
                    </ul>
                </div>

                <!-- Column 3: Customer Service (3 cols) -->
                <div class="lg:col-span-3 space-y-4">
                    <h4 class="font-bold text-sm text-white uppercase tracking-wider">Customer Service</h4>
                    <ul class="space-y-2.5 text-xs text-white">
                        <li><a href="{{ route('catalog') }}" class="hover:text-[#ed6f7c] transition"
                                wire:navigate>Reservations</a></li>
                        <li><a href="#" class="hover:text-[#ed6f7c] transition">FAQs</a></li>
                        <li><a href="#" class="hover:text-[#ed6f7c] transition">Rental Policies</a></li>
                        <li><a href="#" class="hover:text-[#ed6f7c] transition">Insurance</a></li>
                        <li><a href="tel:242-376-1454" class="hover:text-white transition">Support: (242) 376-1454</a>
                        </li>
                    </ul>
                </div>

                <!-- Column 4: Newsletter (3 cols) -->
                <div class="lg:col-span-3 space-y-4">
                    <h4 class="font-bold text-sm text-white uppercase tracking-wider">Newsletter</h4>
                    <p class="text-xs text-white leading-relaxed">
                        Subscribe for exclusive deals, island guide discounts, and travel tips!
                    </p>

                    <form onsubmit="event.preventDefault(); alert('Thank you for subscribing!');"
                        class="flex items-center">
                        <input type="email" placeholder="Enter your email" required
                            class="w-full bg-white text-zinc-900 text-xs px-3.5 py-2.5 rounded-l-lg border-0 focus:outline-none placeholder:text-zinc-400" />
                        <button type="submit"
                            class="bg-accent hover:bg-[#006873] text-white px-3.5 py-2.5 rounded-r-lg transition flex items-center justify-center">
                            <svg class="w-4 h-4 transform rotate-45" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                        </button>
                    </form>
                </div>

            </div>

            <!-- Bottom Copyright & Legal Row -->
            <div
                class="pt-8 border-t border-[#ed6f7c] flex flex-col sm:flex-row items-center justify-between text-[11px] text-white gap-4">
                <div>
                    &copy; {{ date('Y') }} W Major Enterprises Rental. All rights reserved.
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="hover:text-white transition">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition">Terms & Conditions</a>
                </div>
            </div>

        </div>
    </footer>
</x-layouts::app.header>
