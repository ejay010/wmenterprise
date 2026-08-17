<x-layouts::app.sidebar>
    <flux:heading size="xl" class="mb-6">{{ __('My Dashboard') }}</flux:heading>

    @php
        $agreements = \App\Models\RentalAgreement::where('user_id', auth()->id())
            ->orWhere('email', auth()->user()->email)
            ->latest()
            ->get();
    @endphp

    @if ($agreements->count() > 0)
        <div class="space-y-4">
            <flux:heading size="lg">{{ __('My Rental Agreements') }}</flux:heading>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($agreements as $agreement)
                    <div
                        class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-4 shadow-sm">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <flux:heading size="md">Agreement #{{ $agreement->id }}</flux:heading>
                                <flux:text class="text-sm text-zinc-500">{{ $agreement->vehicle->make }}
                                    {{ $agreement->vehicle->model }}</flux:text>
                            </div>
                            <flux:badge color="{{ $agreement->status === 'confirmed' ? 'green' : 'zinc' }}"
                                size="sm">
                                {{ ucfirst($agreement->status) }}
                            </flux:badge>
                        </div>
                        <div class="text-sm space-y-1 mb-4">
                            <div><strong>Dates:</strong> {{ $agreement->pickup_date?->format('M d, Y') }} -
                                {{ $agreement->return_date?->format('M d, Y') }}</div>
                            <div><strong>Total:</strong> ${{ number_format($agreement->total_due, 2) }}</div>
                        </div>
                        <flux:button class="w-full" variant="ghost" icon="document-arrow-down"
                            href="{{ route('agreements.pdf', $agreement) }}" target="_blank">
                            {{ __('Download PDF') }}
                        </flux:button>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="bg-zinc-50 dark:bg-zinc-800 rounded-lg p-8 text-center border border-zinc-200 dark:border-zinc-700">
            <flux:icon.document-text class="size-12 mx-auto text-zinc-400 mb-4" />
            <flux:heading size="lg" class="mb-2">{{ __('No Rental Agreements') }}</flux:heading>
            <flux:text class="text-zinc-500 mb-6">{{ __('You haven\'t made any bookings yet.') }}</flux:text>
            <flux:button href="{{ route('catalog') }}" wire:navigate variant="primary">{{ __('Browse Vehicles') }}
            </flux:button>
        </div>
    @endif
</x-layouts::app.sidebar>
