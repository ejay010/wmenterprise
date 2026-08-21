<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <!-- Success Banner -->
    <div class="bg-white dark:bg-zinc-800 rounded-3xl p-8 sm:p-10 border border-zinc-200 dark:border-zinc-700 shadow-sm text-center mb-8">
        <div class="w-16 h-16 bg-emerald-100 dark:bg-emerald-900/40 text-emerald-600 dark:text-emerald-400 rounded-full flex items-center justify-center mx-auto mb-6">
            <flux:icon.check class="w-8 h-8" />
        </div>

        <flux:heading size="2xl" class="mb-2">Thank You for Your Booking!</flux:heading>
        <flux:subheading size="lg" class="max-w-xl mx-auto">
            Your reservation is confirmed. A copy of your signed rental agreement has been emailed to 
            <span class="font-medium text-zinc-900 dark:text-white">{{ $order->guest_email }}</span>.
        </flux:subheading>

        <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
            @if($order->rentalAgreement)
                <flux:button variant="primary" icon="arrow-down-tray" href="{{ route('agreements.pdf', $order->rentalAgreement) }}" target="_blank">
                    Download Signed Agreement (PDF)
                </flux:button>
            @endif

            @auth
                <flux:button variant="subtle" href="{{ route('dashboard') }}" wire:navigate>
                    Go to Dashboard
                </flux:button>
            @else
                <flux:button variant="subtle" href="{{ route('catalog') }}" wire:navigate>
                    Browse More Vehicles
                </flux:button>
            @endauth
        </div>
    </div>

    <!-- Booking & Vehicle Summary Details -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Vehicle Overview Card -->
        <div class="bg-white dark:bg-zinc-800 rounded-2xl p-6 border border-zinc-200 dark:border-zinc-700 shadow-sm">
            <flux:heading size="lg" class="mb-4">Rented Vehicle</flux:heading>
            
            @php
                $featuredImage = $order->vehicle->images->where('is_featured', true)->first();
                $imageUrl = $featuredImage ? $featuredImage->url : 'https://placehold.co/600x400?text=No+Image';
            @endphp
            <div class="aspect-video rounded-xl overflow-hidden bg-zinc-100 dark:bg-zinc-900 mb-4 border border-zinc-200 dark:border-zinc-700">
                <img src="{{ $imageUrl }}" alt="{{ $order->vehicle->make }} {{ $order->vehicle->model }}" class="w-full h-full object-cover">
            </div>

            <div class="font-bold text-lg text-zinc-900 dark:text-white">
                {{ $order->vehicle->year }} {{ $order->vehicle->make }} {{ $order->vehicle->model }}
            </div>
            <div class="text-sm text-zinc-500 mt-1 capitalize">
                {{ $order->vehicle->class }} • {{ $order->vehicle->fuel_type }}
            </div>
        </div>

        <!-- Schedule & Location Details -->
        <div class="bg-white dark:bg-zinc-800 rounded-2xl p-6 border border-zinc-200 dark:border-zinc-700 shadow-sm">
            <flux:heading size="lg" class="mb-4">Schedule & Locations</flux:heading>

            <div class="space-y-4">
                <div>
                    <div class="text-xs font-semibold uppercase text-zinc-400">Pickup Date & Location</div>
                    <div class="font-medium text-zinc-900 dark:text-white mt-1">
                        {{ $order->start_date ? $order->start_date->format('M d, Y') : 'N/A' }} 
                        @if($order->rentalAgreement)
                            at {{ $order->rentalAgreement->pickup_time }}
                        @endif
                    </div>
                    <div class="text-sm text-zinc-500">
                        {{ $order->rentalAgreement?->pickup_location ?? 'Rock Sound International Airport' }}
                    </div>
                </div>

                <div class="border-t border-zinc-100 dark:border-zinc-700/60 pt-3">
                    <div class="text-xs font-semibold uppercase text-zinc-400">Return Date & Location</div>
                    <div class="font-medium text-zinc-900 dark:text-white mt-1">
                        {{ $order->end_date ? $order->end_date->format('M d, Y') : 'N/A' }}
                        @if($order->rentalAgreement)
                            at {{ $order->rentalAgreement->return_time }}
                        @endif
                    </div>
                    <div class="text-sm text-zinc-500">
                        {{ $order->rentalAgreement?->return_location ?? 'Rock Sound International Airport' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment & Renter Info -->
        <div class="bg-white dark:bg-zinc-800 rounded-2xl p-6 border border-zinc-200 dark:border-zinc-700 shadow-sm">
            <flux:heading size="lg" class="mb-4">Payment & Customer</flux:heading>

            <div class="space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-zinc-500">Order Ref:</span>
                    <span class="font-mono text-zinc-900 dark:text-white">#{{ $order->id }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-zinc-500">Renter Name:</span>
                    <span class="font-medium text-zinc-900 dark:text-white">{{ $order->guest_first_name }} {{ $order->guest_last_name }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-zinc-500">Email:</span>
                    <span class="font-medium text-zinc-900 dark:text-white truncate max-w-[150px]">{{ $order->guest_email }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-zinc-500">Status:</span>
                    <span class="px-2 py-0.5 rounded text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/60 dark:text-emerald-300 capitalize">
                        {{ $order->status }}
                    </span>
                </div>

                <div class="border-t border-zinc-100 dark:border-zinc-700/60 pt-3 mt-3 flex justify-between items-center">
                    <span class="font-bold text-zinc-900 dark:text-white">Total Amount Paid:</span>
                    <span class="font-bold text-lg text-emerald-600 dark:text-emerald-400">${{ number_format($order->total_amount, 2) }} USD</span>
                </div>
            </div>
        </div>
    </div>
</div>
