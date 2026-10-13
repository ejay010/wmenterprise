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
                WM Car Rental
            </span>
            <h1 class="text-4xl sm:text-5xl font-extrabold text-zinc-900 tracking-tight leading-[1.15] mb-4">
                Rental Policy & Guidelines
            </h1>
            <p class="text-base sm:text-lg text-zinc-700 max-w-2xl mx-auto font-normal leading-relaxed">
                Clear, transparent, and fair policies to ensure a safe, comfortable, and memorable trip across Eleuthera.
            </p>
        </div>
    </section>

    <!-- Essential Rules Highlights (Quick Cards) -->
    <section class="py-12 bg-white border-b border-zinc-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- 1. Fuel Policy -->
                <div class="bg-amber-50/70 border border-amber-200/80 rounded-2xl p-6 space-y-2">
                    <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center font-bold text-base">
                        ⛽
                    </div>
                    <flux:heading size="base" class="text-amber-950 font-bold">Fuel Level Return</flux:heading>
                    <p class="text-xs text-amber-900/80 leading-relaxed">
                        Return vehicle at the same fuel level indicated at pick-up. A charge of <strong>$20.00 per quarter tank</strong> applies if returned under.
                    </p>
                </div>

                <!-- 2. Smoke Free -->
                <div class="bg-rose-50/70 border border-rose-200/80 rounded-2xl p-6 space-y-2">
                    <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-800 flex items-center justify-center font-bold text-base">
                        🚭
                    </div>
                    <flux:heading size="base" class="text-rose-950 font-bold">100% Smoke-Free</flux:heading>
                    <p class="text-xs text-rose-900/80 leading-relaxed">
                        All fleet vehicles are strictly non-smoking. A sanitization fee of <strong>$250.00</strong> is assessed for smoking violations.
                    </p>
                </div>

                <!-- 3. Authorized Drivers -->
                <div class="bg-teal-50/70 border border-teal-200/80 rounded-2xl p-6 space-y-2">
                    <div class="w-10 h-10 rounded-xl bg-teal-100 text-teal-800 flex items-center justify-center font-bold text-base">
                        🪪
                    </div>
                    <flux:heading size="base" class="text-teal-950 font-bold">Authorized Drivers Only</flux:heading>
                    <p class="text-xs text-teal-900/80 leading-relaxed">
                        Only individuals holding a valid driver's license and listed on the signed agreement are insured and permitted to drive.
                    </p>
                </div>

                <!-- 4. Geographic Bounds -->
                <div class="bg-sky-50/70 border border-sky-200/80 rounded-2xl p-6 space-y-2">
                    <div class="w-10 h-10 rounded-xl bg-sky-100 text-sky-800 flex items-center justify-center font-bold text-base">
                        🏝️
                    </div>
                    <flux:heading size="base" class="text-sky-950 font-bold">Eleuthera Only</flux:heading>
                    <p class="text-xs text-sky-900/80 leading-relaxed">
                        Vehicles must remain on public highways and graded roads in Eleuthera and cannot be transported off island without written consent.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- Detailed Policy Sections -->
    <section class="py-16 lg:py-20 bg-zinc-50" id="policy-details">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

            <!-- Section 1: Authorized Use & Driver Eligibility -->
            <div class="bg-white p-8 sm:p-10 rounded-2xl border border-zinc-200 shadow-xs space-y-4">
                <div class="flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-teal-50 text-[#007f8c] flex items-center justify-center font-extrabold text-sm">
                        1
                    </span>
                    <flux:heading size="xl" class="text-[#0a192f] font-bold">Authorized Use & Drivers</flux:heading>
                </div>
                <div class="text-sm text-zinc-600 leading-relaxed space-y-3 pt-2">
                    <p>
                        The rented vehicle may be operated <strong>only</strong> by an Authorized Driver. An Authorized Driver is defined as:
                    </p>
                    <ul class="list-disc pl-5 space-y-1.5 text-zinc-700">
                        <li>The primary Renter holding a current, valid driver's license verified prior to vehicle release.</li>
                        <li>Any licensed additional driver who has been accepted and formally registered on the Rental Agreement.</li>
                    </ul>
                    <p>
                        Allowing an unauthorized individual to operate the vehicle constitutes a breach of contract and immediately voids liability insurance coverage.
                    </p>
                </div>
            </div>

            <!-- Section 2: Prohibited Uses -->
            <div class="bg-white p-8 sm:p-10 rounded-2xl border border-zinc-200 shadow-xs space-y-4">
                <div class="flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-teal-50 text-[#007f8c] flex items-center justify-center font-extrabold text-sm">
                        2
                    </span>
                    <flux:heading size="xl" class="text-[#0a192f] font-bold">Prohibited Uses</flux:heading>
                </div>
                <div class="text-sm text-zinc-600 leading-relaxed space-y-3 pt-2">
                    <p>The Renter agrees that the vehicle shall <strong>not</strong> be:</p>
                    <ul class="list-disc pl-5 space-y-1.5 text-zinc-700">
                        <li>Used to carry passengers or property for hire (rideshare, taxi, or commercial transport).</li>
                        <li>Used to propel or tow any other vehicle, trailer, boat, or object.</li>
                        <li>Used in any race, speed test, rally, or driver contest.</li>
                        <li>Operated by any person under the influence of alcohol, drugs, intoxicants, or narcotics.</li>
                        <li>Used in the commission of any illegal activity, crime, or unlawful transport.</li>
                        <li>Removed from the island of Eleuthera without prior written permission from W. Major Enterprises.</li>
                        <li>Operated on rough unpaved tracks or areas other than public highways, graded roads, or paved driveways.</li>
                        <li>Left unattended without being properly locked with the keys secured.</li>
                    </ul>
                </div>
            </div>

            <!-- Section 3: Vehicle Condition, Inspection & Returns -->
            <div class="bg-white p-8 sm:p-10 rounded-2xl border border-zinc-200 shadow-xs space-y-4">
                <div class="flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-teal-50 text-[#007f8c] flex items-center justify-center font-extrabold text-sm">
                        3
                    </span>
                    <flux:heading size="xl" class="text-[#0a192f] font-bold">Vehicle Condition & Return</flux:heading>
                </div>
                <div class="text-sm text-zinc-600 leading-relaxed space-y-3 pt-2">
                    <p>
                        The vehicle is inspected and delivered to you in clean, good operating condition. You agree to return the vehicle in the same condition (except for ordinary wear and tear) to the agreed location, date, and time.
                    </p>
                    <p>
                        <strong>Unauthorized Drop-Off Locations:</strong> Returning the vehicle to a location other than that specified on your rental agreement incurs additional daily rental rate(s) plus an applicable one-way relocation charge.
                    </p>
                    <p>
                        <strong>Vehicle Repossession:</strong> The company maintains the right to locate and repossess the vehicle at the renter's expense if illegally parked, used in breach of driving restrictions, or apparently abandoned.
                    </p>
                </div>
            </div>

            <!-- Section 4: Fuel & Smoke-Free Policies -->
            <div class="bg-white p-8 sm:p-10 rounded-2xl border border-zinc-200 shadow-xs space-y-4">
                <div class="flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-teal-50 text-[#007f8c] flex items-center justify-center font-extrabold text-sm">
                        4
                    </span>
                    <flux:heading size="xl" class="text-[#0a192f] font-bold">Fuel & Smoke-Free Fleet Terms</flux:heading>
                </div>
                <div class="text-sm text-zinc-600 leading-relaxed space-y-3 pt-2">
                    <p>
                        <strong>Fuel Return:</strong> The vehicle must be returned with the fuel gauge at the same level noted upon pickup. Failure to refill to the prescribed level results in an administrative fuel charge of <strong>$20.00 per quarter tank</strong>.
                    </p>
                    <p>
                        <strong>Smoke-Free Vehicle:</strong> For the health and comfort of all travelers, smoking or vaping is strictly prohibited inside any fleet vehicle. A deep cleaning and sanitization fee of <strong>$250.00</strong> will be billed immediately if evidence or odor of smoke is present upon return.
                    </p>
                </div>
            </div>

            <!-- Section 5: Insurance & Liability -->
            <div class="bg-white p-8 sm:p-10 rounded-2xl border border-zinc-200 shadow-xs space-y-4" id="insurance">
                <div class="flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-teal-50 text-[#007f8c] flex items-center justify-center font-extrabold text-sm">
                        5
                    </span>
                    <flux:heading size="xl" class="text-[#0a192f] font-bold">Insurance & Damage Liability</flux:heading>
                </div>
                <div class="text-sm text-zinc-600 leading-relaxed space-y-3 pt-2">
                    <p>
                        WM Car Rental (W Major Enterprises) maintains all mandatory automobile liability insurance required by law in the Commonwealth of the Bahamas.
                    </p>
                    <p>
                        <strong>Limited Power of Attorney:</strong> By signing the rental agreement, the renter grants the company a Limited Power of Attorney to present insurance claims for property damage to the renter's insurance carrier if the vehicle is damaged during the rental period.
                    </p>
                    <p>
                        <strong>Accident Reporting:</strong> Renters must immediately report any accident or damage to the company, file a police report where applicable, and cooperate fully in all claim investigations.
                    </p>
                </div>
            </div>

            <!-- Section 6: Financial Provisions & Fines -->
            <div class="bg-white p-8 sm:p-10 rounded-2xl border border-zinc-200 shadow-xs space-y-4">
                <div class="flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-teal-50 text-[#007f8c] flex items-center justify-center font-extrabold text-sm">
                        6
                    </span>
                    <flux:heading size="xl" class="text-[#0a192f] font-bold">Payment, Traffic Fines & Penalties</flux:heading>
                </div>
                <div class="text-sm text-zinc-600 leading-relaxed space-y-3 pt-2">
                    <ul class="list-disc pl-5 space-y-2 text-zinc-700">
                        <li><strong>Traffic & Parking Fines:</strong> Renters are responsible for all fines, penalties, tickets, and court costs incurred during the rental period.</li>
                        <li><strong>Late & Overdue Balances:</strong> Unpaid balances accrue interest at <strong>2% per month (24% per annum)</strong> plus reasonable collection/legal costs.</li>
                        <li><strong>Disputed Charges / Chargebacks:</strong> An administration fee of up to <strong>$100.00</strong> is charged in the event of an unjustified credit card chargeback.</li>
                    </ul>
                </div>
            </div>

            <!-- Digital Signature Note -->
            <div class="bg-teal-50 border border-teal-200 rounded-2xl p-6 flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-[#007f8c] text-white flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div>
                    <flux:heading size="base" class="text-[#0a192f] font-bold mb-1">
                        Digital Agreement Delivery
                    </flux:heading>
                    <p class="text-xs text-zinc-600 leading-relaxed">
                        When completing your reservation online, you will digitally sign this agreement. A signed, timestamped PDF copy is automatically emailed to you for your records upon confirmation.
                    </p>
                </div>
            </div>

        </div>
    </section>

    <!-- Footer -->
    @include('partials.footer')
</x-layouts::app.header>
