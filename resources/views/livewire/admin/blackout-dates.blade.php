<div class="space-y-8">
    <div class="flex justify-between items-center">
        <div>
            <flux:heading size="xl">Blackout Dates Management</flux:heading>
            <p class="text-sm text-zinc-500 mt-1">Configure unavailable dates for individual vehicles or platform-wide closures.</p>
        </div>
    </div>

    <!-- Add Blackout Date Form -->
    <flux:card>
        <flux:heading size="lg" class="mb-4">Add Blackout Period</flux:heading>
        
        <form wire:submit="save" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Scope / Vehicle</label>
                    <flux:select wire:model="vehicle_id" placeholder="Select scope">
                        <flux:select.option value="">Platform-Wide (All Vehicles)</flux:select.option>
                        @foreach($vehicles as $v)
                            <flux:select.option value="{{ $v->id }}">{{ $v->year }} {{ $v->make }} {{ $v->model }} ({{ $v->license_plate ?? 'No Plate' }})</flux:select.option>
                        @endforeach
                    </flux:select>
                    @error('vehicle_id') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <flux:input type="date" wire:model="start_date" label="Start Date" required />
                    @error('start_date') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <flux:input type="date" wire:model="end_date" label="End Date" required />
                    @error('end_date') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <flux:input wire:model="reason" label="Reason (Optional)" placeholder="e.g. Maintenance, Holiday" />
                    @error('reason') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex justify-end">
                <flux:button type="submit" variant="primary" icon="plus">
                    Add Blackout Period
                </flux:button>
            </div>
        </form>
    </flux:card>

    <!-- Blackout Dates Table -->
    <div class="space-y-4">
        <div class="flex justify-between items-center">
            <flux:heading size="lg">Configured Blackout Dates</flux:heading>
            
            <div class="w-64">
                <flux:select wire:model.live="filter_vehicle" placeholder="Filter by scope">
                    <flux:select.option value="">All Scopes</flux:select.option>
                    <flux:select.option value="platform">Platform-Wide Only</flux:select.option>
                    @foreach($vehicles as $v)
                        <flux:select.option value="{{ $v->id }}">{{ $v->make }} {{ $v->model }}</flux:select.option>
                    @endforeach
                </flux:select>
            </div>
        </div>

        <flux:table>
            <flux:table.columns>
                <flux:table.column>Scope</flux:table.column>
                <flux:table.column>Date Range</flux:table.column>
                <flux:table.column>Duration</flux:table.column>
                <flux:table.column>Reason</flux:table.column>
                <flux:table.column>Actions</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @forelse($blackouts as $blackout)
                    <flux:table.row wire:key="blackout-{{ $blackout->id }}">
                        <flux:table.cell>
                            @if($blackout->isPlatformWide())
                                <flux:badge color="amber" size="sm">Platform-Wide (All Vehicles)</flux:badge>
                            @else
                                <div class="flex flex-col">
                                    <span class="font-medium text-zinc-900 dark:text-zinc-100">
                                        {{ $blackout->vehicle->year }} {{ $blackout->vehicle->make }} {{ $blackout->vehicle->model }}
                                    </span>
                                    <span class="text-xs text-zinc-500">
                                        Plate: {{ $blackout->vehicle->license_plate ?? 'N/A' }}
                                    </span>
                                </div>
                            @endif
                        </flux:table.cell>

                        <flux:table.cell>
                            <div class="text-sm">
                                <span class="font-medium">{{ $blackout->start_date->format('M d, Y') }}</span>
                                <span class="text-zinc-400 mx-1">to</span>
                                <span class="font-medium">{{ $blackout->end_date->format('M d, Y') }}</span>
                            </div>
                        </flux:table.cell>

                        <flux:table.cell>
                            @php
                                $days = $blackout->start_date->diffInDays($blackout->end_date) + 1;
                            @endphp
                            <span class="text-sm text-zinc-500">{{ $days }} {{ \Illuminate\Support\Str::plural('day', $days) }}</span>
                        </flux:table.cell>

                        <flux:table.cell>
                            <span class="text-sm text-zinc-600 dark:text-zinc-400">
                                {{ $blackout->reason ?? '—' }}
                            </span>
                        </flux:table.cell>

                        <flux:table.cell>
                            <flux:button 
                                wire:click="deleteBlackoutDate({{ $blackout->id }})" 
                                wire:confirm="Are you sure you want to remove this blackout period?"
                                variant="danger" 
                                size="sm" 
                                icon="trash">
                                Remove
                            </flux:button>
                        </flux:table.cell>
                    </flux:table.row>
                @empty
                    <flux:table.row>
                        <flux:table.cell colspan="5" class="text-center text-zinc-500 py-8">
                            No blackout dates configured.
                        </flux:table.cell>
                    </flux:table.row>
                @endforelse
            </flux:table.rows>
        </flux:table>

        <div>
            {{ $blackouts->links() }}
        </div>
    </div>
</div>
