<!--
  Vehicle details and dynamic quote calculator view.
  We use Alpine.js (x-data) to power a Facebook-style interactive lightbox image modal.
-->
@php
    // Prepare the list of all images for the vehicle (featured image first, then additional images)
    $allImages = $vehicle->images->sortByDesc('is_featured')->values();
    $imageUrls = $allImages->map(fn($img) => $img->url)->toArray();
    
    // Fallback if no images exist
    if (empty($imageUrls)) {
        $imageUrls = ['https://placehold.co/800x500?text=No+Image'];
    }
@endphp

<div x-data="{
        isOpen: false,
        currentIndex: 0,
        images: @js($imageUrls),
        open(index) {
            this.currentIndex = index;
            this.isOpen = true;
            document.body.classList.add('overflow-hidden'); // Prevent background scrolling
        },
        close() {
            this.isOpen = false;
            document.body.classList.remove('overflow-hidden'); // Restore scrolling
        },
        next() {
            this.currentIndex = (this.currentIndex + 1) % this.images.length;
        },
        prev() {
            this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
        }
    }"
    @keydown.escape.window="close()"
    @keydown.arrow-right.window="if(isOpen) next()"
    @keydown.arrow-left.window="if(isOpen) prev()"
    class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

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
                <!-- Main Featured Image -->
                <div @click="open(0)" 
                    class="aspect-[16/9] relative rounded-2xl overflow-hidden bg-zinc-100 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 cursor-pointer group">
                    <img :src="images[0]" alt="{{ $vehicle->make }} {{ $vehicle->model }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    
                    <!-- Click to enlarge overlay hint -->
                    <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white font-medium text-sm gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                        Click to enlarge
                    </div>
                </div>
                
                <!-- Thumbnail Strip -->
                @if(count($imageUrls) > 1)
                    <div class="grid grid-cols-4 sm:grid-cols-5 gap-4">
                        @foreach($imageUrls as $index => $url)
                            <div @click="open({{ $index }})" 
                                class="aspect-video relative rounded-lg overflow-hidden border border-zinc-200 dark:border-zinc-700 bg-zinc-100 dark:bg-zinc-900 cursor-pointer hover:opacity-80 transition group">
                                <img src="{{ $url }}" alt="Thumbnail {{ $index + 1 }}" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity"></div>
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

    <!-- Facebook-Style Lightbox Modal -->
    <template x-teleport="body">
        <div x-show="isOpen" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex flex-col justify-between bg-black/95 text-white select-none"
            style="display: none;">
            
            <!-- Modal Header (Close button & Counter) -->
            <div class="flex items-center justify-between p-4 bg-gradient-to-b from-black/80 to-transparent z-10">
                <div class="text-sm font-medium text-zinc-300">
                    {{ $vehicle->year }} {{ $vehicle->make }} {{ $vehicle->model }}
                    <span class="mx-2 text-zinc-500">•</span>
                    <span x-text="(currentIndex + 1) + ' of ' + images.length"></span>
                </div>
                
                <!-- Close Button -->
                <button @click="close()" type="button" class="p-2 rounded-full text-zinc-300 hover:text-white hover:bg-white/10 transition cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Modal Content (Image + Previous/Next Controls) -->
            <div class="relative flex-1 flex items-center justify-center p-4" @click.self="close()">
                <!-- Previous Button -->
                <button x-show="images.length > 1" @click.stop="prev()" type="button" 
                    class="absolute left-4 p-3 rounded-full bg-black/50 text-white hover:bg-white/20 transition cursor-pointer z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>

                <!-- Active Image View -->
                <div class="max-w-5xl max-h-[75vh] flex items-center justify-center">
                    <img :src="images[currentIndex]" 
                        alt="Vehicle Image" 
                        class="max-w-full max-h-[75vh] object-contain rounded-lg shadow-2xl transition-all duration-300">
                </div>

                <!-- Next Button -->
                <button x-show="images.length > 1" @click.stop="next()" type="button" 
                    class="absolute right-4 p-3 rounded-full bg-black/50 text-white hover:bg-white/20 transition cursor-pointer z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>

            <!-- Modal Footer (Thumbnail Strip) -->
            <div x-show="images.length > 1" class="p-4 bg-gradient-to-t from-black/80 to-transparent flex justify-center gap-3 overflow-x-auto">
                <template x-for="(img, idx) in images" :key="idx">
                    <div @click="currentIndex = idx" 
                        class="w-16 h-12 rounded-md overflow-hidden cursor-pointer border-2 transition shrink-0"
                        :class="currentIndex === idx ? 'border-accent scale-105' : 'border-transparent opacity-50 hover:opacity-100'">
                        <img :src="img" class="w-full h-full object-cover">
                    </div>
                </template>
            </div>
        </div>
    </template>
</div>
