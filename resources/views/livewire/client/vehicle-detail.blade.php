<!--
  Vehicle details and dynamic quote calculator view.
-->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Back Button -->
    <div class="mb-6">
        <flux:button href="{{ route('catalog') }}" variant="ghost" icon="arrow-left" wire:navigate>
            Back to Catalog
        </flux:button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Left Side: Images & Details -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Image Gallery -->
            <div class="space-y-4">
                @php
                    $featuredImage = $vehicle->images->where('is_featured', true)->first();
                    $otherImages = $vehicle->images->where('is_featured', false);
                    $mainImagePath = $featuredImage ? asset('storage/' . $featuredImage->image_path) : 'https://placehold.co/800x500?text=No+Image';
                @endphp
                
                <!-- Main Featured Image -->
                <div class="aspect-[16/9] relative rounded-2xl overflow-hidden bg-zinc-100 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700">
                    <img src="{{ $mainImagePath }}" alt="{{ $vehicle->make }}" class="w-full h-full object-cover">
                </div>
                
                <!-- Thumbnail Strip -->
                @if($otherImages->count() > 0)
                    <div class="grid grid-cols-4 sm:grid-cols-5 gap-4">
                        @foreach($otherImages as $img)
                            <div class="aspect-video relative rounded-lg overflow-hidden border border-zinc-200 dark:border-zinc-700 bg-zinc-100 dark:bg-zinc-900 cursor-pointer hover:opacity-80 transition">
                                <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-full object-cover">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Vehicle Info -->
            <div class="bg-white dark:bg-zinc-800 rounded-2xl p-8 border border-zinc-200 dark:border-zinc-700">
                <flux:heading size="2xl" class="mb-4">{{ $vehicle->year }} {{ $vehicle->make }} {{ $vehicle->model }}</flux:heading>
                
                <div class="prose dark:prose-invert max-w-none text-zinc-600 dark:text-zinc-400">
                    <p>{{ $vehicle->description ?? 'No detailed description provided for this vehicle.' }}</p>
                </div>

                <flux:separator class="my-6" />
                
                <!-- Highlights grid -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
                    <div>
                        <div class="text-sm text-zinc-500">License Plate</div>
                        <div class="font-medium text-zinc-900 dark:text-white">{{ $vehicle->license_plate }}</div>
                    </div>
                    <div>
                        <div class="text-sm text-zinc-500">Daily Rate</div>
                        <div class="font-medium text-primary-600">${{ number_format($vehicle->daily_rate, 2) }}</div>
                    </div>
                    <div>
                        <div class="text-sm text-zinc-500">Status</div>
                        <div class="font-medium text-zinc-900 dark:text-white">{{ ucfirst($vehicle->status) }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Booking Widget -->
        <div class="lg:col-span-1">
            <!-- We use sticky positioning so the widget stays on screen as the user scrolls -->
            <div class="bg-white dark:bg-zinc-800 rounded-2xl p-6 border border-zinc-200 dark:border-zinc-700 sticky top-8 shadow-sm">
                <flux:heading size="xl" class="mb-6">Book this vehicle</flux:heading>
                
                <form wire:submit="continueToBooking" class="space-y-6">
                    
                    <div class="space-y-4">
                        <!-- Date Pickers bound to Livewire properties -->
                        <!-- When these change, the `updated` hook in the component fires and recalculates the total -->
                        <flux:input type="date" wire:model.live="pickup_date" label="Pick-up Date" required min="{{ date('Y-m-d') }}" />
                        
                        <flux:input type="date" wire:model.live="return_date" label="Return Date" required min="{{ $pickup_date ?? date('Y-m-d') }}" />
                    </div>

                    <!-- Dynamic Quote Summary -->
                    <div class="bg-zinc-50 dark:bg-zinc-900 rounded-xl p-4 space-y-3 border border-zinc-100 dark:border-zinc-700">
                        <div class="flex justify-between text-zinc-600 dark:text-zinc-400">
                            <span>${{ number_format($vehicle->daily_rate, 2) }} × {{ $days }} days</span>
                            <span>${{ number_format($total_estimate, 2) }}</span>
                        </div>
                        <flux:separator />
                        <div class="flex justify-between font-bold text-lg text-zinc-900 dark:text-white">
                            <span>Total</span>
                            <span>${{ number_format($total_estimate, 2) }}</span>
                        </div>
                    </div>

                    @if($days <= 0)
                        <div class="text-sm text-red-500 font-medium">Please select a valid date range (at least 1 day).</div>
                    @endif

                    <!-- Submit Button -->
                    <flux:button type="submit" variant="primary" class="w-full" :disabled="$days <= 0">
                        Continue to Booking
                    </flux:button>
                </form>
            </div>
        </div>
    </div>
</div>
