<!--
  This is the form view for adding or editing a vehicle.
  We use standard form submission tied to Livewire's wire:submit.
-->
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <!-- A button to navigate back to the vehicle list -->
        <flux:button href="{{ route('admin.vehicles.index') }}" variant="ghost" icon="arrow-left" wire:navigate />
        <flux:heading size="xl">{{ $vehicle ? 'Edit Vehicle' : 'Add New Vehicle' }}</flux:heading>
    </div>

    <!--
      The form calls the `save` method on the Livewire component when submitted.
      wire:submit prevents the default browser POST behavior and handles it via AJAX.
    -->
    <form wire:submit="save" class="space-y-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- wire:model automatically binds the input value to the component's property -->
            <flux:input wire:model="make" label="Make" placeholder="e.g. Toyota" required />
            <flux:input wire:model="model" label="Model" placeholder="e.g. Corolla" required />
            <flux:input wire:model="year" type="number" label="Year" placeholder="2024" required />
            <flux:input wire:model="color" label="Color" placeholder="e.g. Red" required />
            <flux:select wire:model="class" label="Class" required>
                <flux:select.option value="SUV">SUV</flux:select.option>
                <flux:select.option value="Sedan">Sedan</flux:select.option>
                <flux:select.option value="Compact">Compact</flux:select.option>
                <flux:select.option value="Sub-Compact">Sub-Compact</flux:select.option>
                <flux:select.option value="Truck">Truck</flux:select.option>
                <flux:select.option value="Mid-Size">Mid-Size</flux:select.option>
                <flux:select.option value="Full-Size">Full-Size</flux:select.option>
            </flux:select>
            <flux:input wire:model="max_passengers" type="number" label="Max Passengers" placeholder="4" required />
            <flux:input wire:model="fuel_type" label="Fuel Type" placeholder="e.g. Gasoline" required />
            <flux:input wire:model="gearbox" label="Gearbox" placeholder="e.g. Automatic" required />
            <flux:input wire:model="license_plate" label="License Plate" placeholder="XYZ-1234" required />

            <div class="col-span-1 md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- We allow numeric input for daily rate -->
                <flux:input wire:model="daily_rate" type="number" step="0.01" label="Daily Rate ($)"
                    placeholder="50.00" required />

                <flux:select wire:model="status" label="Status" required>
                    <flux:select.option value="available">Available</flux:select.option>
                    <flux:select.option value="maintenance">In Maintenance</flux:select.option>
                </flux:select>
            </div>

            <div class="col-span-1 md:col-span-2">
                <flux:textarea wire:model="description" label="Description"
                    placeholder="Optional details about the vehicle..." rows="3" />
            </div>
        </div>

        <flux:separator />

        <!-- Image Upload Section -->
        <div>
            <flux:heading size="lg" class="mb-4">Vehicle Images</flux:heading>

            <!--
              Livewire file upload field.
              multiple: allows selecting multiple files at once.
              accept="image/*": restricts file picker to images only.
            -->
            <flux:input type="file" wire:model="new_images" label="Upload New Images" multiple accept="image/*" />

            <!-- Displaying newly selected image (preview before saving) -->
            @if ($new_images)
                @php
                    $previewPhotos = is_array($new_images) ? $new_images : [$new_images];
                @endphp
                <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach ($previewPhotos as $photo)
                        <div
                            class="relative rounded-lg overflow-hidden border border-zinc-200 dark:border-zinc-700 aspect-video">
                            <!-- temporaryUrl() provides a preview of the uploaded file before it is permanently stored -->
                            <img src="{{ $photo->temporaryUrl() }}" class="w-full h-full object-cover">
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Displaying already saved images -->
            @if (count($existing_images) > 0)
                <div class="mt-6">
                    <h4 class="text-sm font-medium text-zinc-900 dark:text-zinc-100 mb-3">Saved Images</h4>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach ($existing_images as $image)
                            <div
                                class="relative rounded-lg overflow-hidden border {{ $featured_image_id === $image->id ? 'border-primary-500 ring-2 ring-primary-500' : 'border-zinc-200 dark:border-zinc-700' }} aspect-video group">
                                <img src="{{ $image->url }}" class="w-full h-full object-cover">

                                <!-- Overlay container for actions on hover -->
                                <div
                                    class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                                    <!-- Button to set this image as featured -->
                                    @if ($featured_image_id !== $image->id)
                                        <flux:button size="sm" variant="filled"
                                            wire:click="setFeaturedImage({{ $image->id }})" title="Set as Featured">
                                            Feature
                                        </flux:button>
                                    @endif

                                    <!-- Button to delete this image -->
                                    <flux:button size="sm" variant="danger" icon="trash"
                                        wire:click="deleteImage({{ $image->id }})" wire:confirm="Delete this image?"
                                        title="Delete Image" />
                                </div>

                                <!-- Badge displaying if it is currently featured -->
                                @if ($featured_image_id === $image->id)
                                    <div
                                        class="absolute top-2 left-2 bg-primary-500 text-white text-xs font-bold px-2 py-1 rounded">
                                        Featured
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div class="flex justify-end gap-3 pt-6">
            <flux:button href="{{ route('admin.vehicles.index') }}" variant="ghost" wire:navigate>Cancel</flux:button>
            <flux:button type="submit" variant="primary">Save Vehicle</flux:button>
        </div>
    </form>
</div>
