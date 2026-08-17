<!--
  This view displays a list of all completed rental agreements to the admin.
-->
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <flux:heading size="xl">Rental Agreements</flux:heading>
    </div>

    <!-- Data table to present the agreements cleanly -->
    <flux:table>
        <flux:table.columns>
            <flux:table.column>Agreement ID</flux:table.column>
            <flux:table.column>Guest Name</flux:table.column>
            <flux:table.column>Vehicle</flux:table.column>
            <flux:table.column>Rental Period</flux:table.column>
            <flux:table.column>Status</flux:table.column>
            <flux:table.column>Actions</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @forelse($agreements as $agreement)
                <flux:table.row wire:key="agreement-{{ $agreement->id }}">
                    <flux:table.cell>
                        <span class="font-medium">#{{ $agreement->id }}</span>
                    </flux:table.cell>
                    <flux:table.cell>
                        <div class="flex flex-col">
                            <span class="font-medium">{{ $agreement->first_name }} {{ $agreement->last_name }}</span>
                            <span class="text-sm text-zinc-500">{{ $agreement->email }}</span>
                        </div>
                    </flux:table.cell>
                    <flux:table.cell>
                        {{ $agreement->vehicle->year ?? '' }} {{ $agreement->vehicle->make ?? 'Unknown' }} {{ $agreement->vehicle->model ?? '' }}
                    </flux:table.cell>
                    <flux:table.cell>
                        <div class="text-sm">
                            <!-- Format dates for easy reading -->
                            <div>{{ \Carbon\Carbon::parse($agreement->pickup_date)->format('M d, Y') }}</div>
                            <div class="text-zinc-400">to</div>
                            <div>{{ \Carbon\Carbon::parse($agreement->return_date)->format('M d, Y') }}</div>
                        </div>
                    </flux:table.cell>
                    <flux:table.cell>
                        <!-- Badge indicating current status -->
                        <flux:badge color="{{ $agreement->status === 'completed' ? 'success' : 'zinc' }}">
                            {{ ucfirst($agreement->status) }}
                        </flux:badge>
                    </flux:table.cell>
                    <flux:table.cell>
                        <!-- 
                          Link to download the generated PDF.
                          We use a standard non-Livewire GET request (data-navigate-ignore) because file downloads
                          need to be handled by the browser directly, not via AJAX.
                        -->
                        <flux:button href="{{ route('agreements.pdf', $agreement) }}" variant="ghost" size="sm" icon="arrow-down-tray" data-navigate-ignore>
                            PDF
                        </flux:button>
                    </flux:table.cell>
                </flux:table.row>
            @empty
                <flux:table.row>
                    <flux:table.cell colspan="6" class="text-center text-zinc-500 py-8">
                        No agreements found.
                    </flux:table.cell>
                </flux:table.row>
            @endforelse
        </flux:table.rows>
    </flux:table>

    <!-- Pagination links -->
    <div class="mt-4">
        {{ $agreements->links() }}
    </div>
</div>
