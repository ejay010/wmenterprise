<!--
  This is the public-facing catalog page.
  It iterates through available vehicles and displays them as cards.
-->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-5xl">
            Choose Your Ride
        </h1>
        <p class="mt-4 max-w-2xl text-xl text-gray-500 dark:text-gray-400 mx-auto">
            Explore our fleet of premium vehicles and find the perfect match for your trip in Eleuthera.
        </p>
    </div>

    <!--
      We use a responsive grid layout.
      1 column on mobile (grid-cols-1), 2 on tablets (md:grid-cols-2), 3 on large screens (lg:grid-cols-3)
    -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($vehicles as $vehicle)
            <div
                class="flex flex-col bg-white dark:bg-zinc-800 rounded-2xl shadow-sm border border-zinc-200 dark:border-zinc-700 overflow-hidden hover:shadow-md transition-shadow duration-300">
                <!-- Vehicle Image -->
                <div class="aspect-video relative overflow-hidden bg-zinc-100 dark:bg-zinc-900">
                    @php
                        // Fetch the featured image or fallback to a placeholder
                        $featuredImage = $vehicle->images->where('is_featured', true)->first();
                        $imagePath = $featuredImage
                            ? $featuredImage->url
                            : 'https://placehold.co/600x400?text=No+Image';
                    @endphp
                    <img src="{{ $imagePath }}" alt="{{ $vehicle->make }} {{ $vehicle->model }}"
                        class="w-full h-full object-cover">

                    <!-- Daily Rate Badge overlaid on the image -->
                    <div
                        class="absolute top-4 right-4 bg-accent text-white px-3 py-1 rounded-full text-sm font-bold shadow-sm">
                        ${{ number_format($vehicle->daily_rate, 2) }} / day
                    </div>
                </div>

                <!-- Vehicle Details -->
                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-zinc-900 dark:text-white">
                            {{ $vehicle->year }} {{ $vehicle->make }} {{ $vehicle->model }}
                        </h3>
                        <!-- A truncated description -->
                        <p class="mt-2 text-zinc-500 dark:text-zinc-400 line-clamp-2">
                            {{ $vehicle->description ?? 'No description available.' }}
                        </p>
                    </div>

                    <!-- Call to Action Button -->
                    <div class="mt-6">
                        <!-- We use wire:navigate to seamlessly load the details page -->
                        <flux:button href="{{ route('vehicle.show', $vehicle) }}" variant="primary" class="w-full"
                            wire:navigate>
                            View Details & Book
                        </flux:button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-xl text-zinc-500">No vehicles are currently available. Please check back later.</p>
            </div>
        @endforelse
    </div>
</div>
