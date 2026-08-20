<!--
  This view renders the list of vehicles for the administrator.
  We use Flux UI components (e.g. flux:heading, flux:button, flux:table) to build a consistent and accessible UI.
-->
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <!-- The header for the page -->
        <flux:heading size="xl">Vehicles</flux:heading>

        <!--
          A button linking to the 'create vehicle' route.
          We use wire:navigate to allow Livewire to handle the page transition smoothly without a full page reload.
        -->
        <flux:button href="{{ route('admin.vehicles.create') }}" variant="primary" wire:navigate>
            Add Vehicle
        </flux:button>
    </div>

    <!-- The data table to display vehicles -->
    <flux:table>
        <!-- Table headers -->
        <flux:table.columns>
            <flux:table.column>Make & Model</flux:table.column>
            <flux:table.column>Color</flux:table.column>
            <flux:table.column>License Plate</flux:table.column>
            <flux:table.column>Class</flux:table.column>
            <flux:table.column>Max Passengers</flux:table.column>
            <flux:table.column>Fuel Type</flux:table.column>
            <flux:table.column>Gearbox</flux:table.column>
            <flux:table.column>Daily Rate</flux:table.column>
            <flux:table.column>Status</flux:table.column>
            <flux:table.column>Actions</flux:table.column>
        </flux:table.columns>

        <!-- Table body where we loop through each vehicle -->
        <flux:table.rows>
            @forelse($vehicles as $vehicle)
                <!--
                  We must set a unique key on elements inside a loop in Livewire so it can track them properly during updates.
                -->
                <flux:table.row wire:key="vehicle-{{ $vehicle->id }}">
                    <flux:table.cell>
                        <div class="flex items-center gap-3">
                            <!--
                              We display the featured image if it exists.
                              We check the vehicle's images relationship and find the one marked as featured.
                            -->
                            @php
                                $featuredImage = $vehicle->images->where('is_featured', true)->first();
                                $imagePath = $featuredImage
                                    ? $featuredImage->url
                                    : 'https://placehold.co/100x60?text=No+Image';
                            @endphp
                            <div class="w-16 h-10 rounded overflow-hidden bg-gray-100 dark:bg-gray-800">
                                <img src="{{ $imagePath }}" alt="Vehicle Image" class="w-full h-full object-cover">
                            </div>
                            <!-- We output the vehicle's year, make, and model -->
                            <div class="font-medium text-gray-900 dark:text-white">
                                {{ $vehicle->year }} {{ $vehicle->make }} {{ $vehicle->model }}
                            </div>
                        </div>
                    </flux:table.cell>

                    <flux:table.cell>
                        {{ $vehicle->color }}
                    </flux:table.cell>

                    <flux:table.cell>
                        {{ $vehicle->license_plate }}

                    </flux:table.cell>
                    <flux:table.cell>

                        {{ $vehicle->class }}
                    </flux:table.cell>
                    <flux:table.cell>
                        {{ $vehicle->max_passengers }}

                    </flux:table.cell>
                    <flux:table.cell>

                        {{ $vehicle->fuel_type }}

                    </flux:table.cell>
                    <flux:table.cell>
                        {{ $vehicle->gearbox }}

                    </flux:table.cell>
                    <flux:table.cell>
                        <!-- We format the daily rate as currency -->
                        ${{ number_format($vehicle->daily_rate, 2) }}
                    </flux:table.cell>
                    <flux:table.cell>
                        <!--
                          We display a badge indicating if the vehicle is available or in maintenance.
                          We use Alpine/Tailwind classes conditionally.
                        -->
                        <flux:badge color="{{ $vehicle->status === 'available' ? 'success' : 'warning' }}">
                            {{ ucfirst($vehicle->status) }}
                        </flux:badge>
                    </flux:table.cell>
                    <flux:table.cell>
                        <!--
                          The actions dropdown menu for each vehicle (Edit, Delete).
                          We use Flux dropdown components for a clean UI.
                        -->
                        <flux:dropdown>
                            <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" />

                            <flux:menu>
                                <!-- The Edit option takes the user to the edit form -->
                                <flux:menu.item icon="pencil" href="{{ route('admin.vehicles.edit', $vehicle) }}"
                                    wire:navigate>Edit</flux:menu.item>

                                <!--
                                  The Delete option uses wire:click to call the deleteVehicle method on our PHP class.
                                  We use wire:confirm to prompt the user before actually executing the deletion.
                                -->
                                <flux:menu.item icon="trash" wire:click="deleteVehicle({{ $vehicle->id }})"
                                    wire:confirm="Are you sure you want to delete this vehicle?" variant="danger">
                                    Delete
                                </flux:menu.item>
                            </flux:menu>
                        </flux:dropdown>
                    </flux:table.cell>
                </flux:table.row>
            @empty
                <!-- This block runs if there are no vehicles in the database -->
                <flux:table.row>
                    <flux:table.cell colspan="5" class="text-center text-zinc-500 py-8">
                        No vehicles found.
                    </flux:table.cell>
                </flux:table.row>
            @endforelse
        </flux:table.rows>
    </flux:table>

    <!--
      This renders the pagination links (e.g. Next, Previous) generated by Livewire's WithPagination trait.
    -->
    <div class="mt-4">
        {{ $vehicles->links() }}
    </div>
</div>
