<!--
  The Checkout view collects driver information, displays the summary,
  and captures a digital signature using an Alpine.js component.
-->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-8 flex items-center justify-between">
        <flux:heading size="2xl">Complete Your Booking</flux:heading>
        <!-- The user can back out if they change their mind -->
        <flux:button href="{{ route('vehicle.show', $vehicle) }}" variant="ghost" icon="arrow-left" wire:navigate>
            Back
        </flux:button>
    </div>

    <form wire:submit="processBooking" class="grid grid-cols-1 lg:grid-cols-3 gap-12">

        <!-- Left Column: Form Fields -->
        <div class="lg:col-span-2 space-y-10">

            <!-- Section 1: Driver's Information -->
            <section
                class="bg-white dark:bg-zinc-800 p-8 rounded-2xl border border-zinc-200 dark:border-zinc-700 shadow-sm">
                <flux:heading size="xl" class="mb-6">Driver's Information</flux:heading>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:input wire:model="first_name" label="First Name" required />
                    <flux:input wire:model="last_name" label="Last Name" required />
                    <flux:input wire:model="date_of_birth" type="date" label="Date of Birth" required />
                    <flux:input wire:model="drivers_license" label="Driver's License" required />

                    <div class="md:col-span-2">
                        <flux:input wire:model="address" label="Address" required />
                    </div>

                    <flux:input wire:model="email" type="email" label="Email" required />
                    <flux:input wire:model="phone" type="tel" label="Phone" required />
                </div>
            </section>

            <!-- Section 2: Logistics -->
            <section
                class="bg-white dark:bg-zinc-800 p-8 rounded-2xl border border-zinc-200 dark:border-zinc-700 shadow-sm">
                <flux:heading size="xl" class="mb-6">Pick Up & Return</flux:heading>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Pickup Details -->
                    <div class="space-y-4">
                        <h4
                            class="font-bold text-zinc-900 dark:text-white border-b pb-2 border-zinc-200 dark:border-zinc-700">
                            Pick Up</h4>
                        <flux:select wire:model="pickup_location" label="Location" required>
                            <flux:select.option value="Rock Sound International Airport">Rock Sound International
                                Airport</flux:select.option>
                            <flux:select.option value="Governor's Harbour International Airport">Governor's Harbour
                                International Airport</flux:select.option>
                        </flux:select>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- We disable the date picker here since it was chosen on the previous screen -->
                            <flux:input value="{{ \Carbon\Carbon::parse($pickup_date)->format('M d, Y') }}"
                                label="Date" disabled />
                            <flux:input type="time" wire:model="pickup_time" label="Time" required />
                        </div>
                    </div>

                    <!-- Return Details -->
                    <div class="space-y-4">
                        <h4
                            class="font-bold text-zinc-900 dark:text-white border-b pb-2 border-zinc-200 dark:border-zinc-700">
                            Return</h4>
                        <flux:select wire:model="return_location" label="Location" required>
                            <flux:select.option value="Rock Sound International Airport">Rock Sound International
                                Airport</flux:select.option>
                            <flux:select.option value="Governor's Harbour International Airport">Governor's Harbour
                                International Airport</flux:select.option>
                        </flux:select>

                        <div class="grid grid-cols-2 gap-4">
                            <flux:input value="{{ \Carbon\Carbon::parse($return_date)->format('M d, Y') }}"
                                label="Date" disabled />
                            <flux:input type="time" wire:model="return_time" label="Time" required />
                        </div>
                    </div>
                </div>
            </section>

            <!-- Section 3: Terms & Signature -->
            <!--
              We use Alpine.js (x-data="signaturePad()") to manage the HTML5 Canvas logic locally in the browser.
              This prevents sending hundreds of requests to Livewire as the user draws.
            -->
            <section
                class="bg-white dark:bg-zinc-800 p-8 rounded-2xl border border-zinc-200 dark:border-zinc-700 shadow-sm"
                x-data="signaturePad()">
                <flux:heading size="xl" class="mb-6">Terms and Conditions</flux:heading>

                <div
                    class="prose dark:prose-invert max-w-none text-sm text-zinc-600 dark:text-zinc-400 h-48 overflow-y-auto border border-zinc-200 dark:border-zinc-700 p-4 rounded mb-6">
                    <p><strong>AUTHORIZED USE:</strong> The VEHICLE may be used ONLY by an AUTHORIZED DRIVER...</p>
                    <p><strong>PROHIBITED USE:</strong> You agree that the VEHICLE shall not be used to carry persons or
                        property for hire, in any race...</p>
                    <p><em>(Please note this is a summary. The full terms will be included in your PDF agreement.)</em>
                    </p>
                </div>

                <div class="mb-6">
                    <flux:checkbox wire:model="agreed_to_terms" label="I agree to the terms and conditions" required />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <flux:input wire:model="renter_name" label="Printed Name" required />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Signature</label>
                        <!--
                          The canvas element where drawing happens.
                          x-ref="canvas" allows Alpine to target this specific element.
                          The @ events trigger the drawing logic based on mouse/touch actions.
                        -->
                        <div
                            class="border-2 border-dashed border-zinc-300 dark:border-zinc-600 rounded-lg bg-zinc-50 dark:bg-zinc-900 relative">
                            <canvas x-ref="canvas" width="300" height="150"
                                class="w-full h-full cursor-crosshair touch-none" @mousedown="startDrawing"
                                @mousemove="draw" @mouseup="stopDrawing" @mouseleave="stopDrawing"
                                @touchstart.prevent="startDrawing" @touchmove.prevent="draw"
                                @touchend.prevent="stopDrawing"></canvas>

                            <!-- Clear button calls the clear() method in our Alpine component -->
                            <button type="button" @click="clear"
                                class="absolute top-2 right-2 text-xs text-zinc-500 hover:text-red-500 bg-white dark:bg-zinc-800 px-2 py-1 rounded shadow-sm border border-zinc-200 dark:border-zinc-700">Clear</button>
                        </div>
                        <!-- Hidden input binds the base64 string to Livewire -->
                        <input type="hidden" wire:model="renter_signature" x-bind:value="signatureData">
                        @error('renter_signature')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </section>
        </div>

        <!-- Right Column: Summary & Payment -->
        <div class="lg:col-span-1">
            <div
                class="bg-white dark:bg-zinc-800 p-8 rounded-2xl border border-zinc-200 dark:border-zinc-700 shadow-sm sticky top-8">
                <flux:heading size="xl" class="mb-6">Booking Summary</flux:heading>

                <div class="flex items-center gap-4 mb-6 pb-6 border-b border-zinc-200 dark:border-zinc-700">
                    <div class="w-20 h-14 rounded overflow-hidden bg-zinc-100 flex-shrink-0">
                        @php
                            $featuredImage = $vehicle->images->where('is_featured', true)->first();
                            $imagePath = $featuredImage
                                ? asset('storage/' . $featuredImage->image_path)
                                : 'https://placehold.co/100x60?text=No+Image';
                        @endphp
                        <img src="{{ $imagePath }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <div class="font-bold text-zinc-900 dark:text-white">{{ $vehicle->year }} {{ $vehicle->make }}
                            {{ $vehicle->model }}</div>
                        <div class="text-sm text-zinc-500">{{ $days }} days rental</div>
                    </div>
                </div>

                <div class="space-y-4 mb-6">
                    <div class="flex justify-between text-zinc-600 dark:text-zinc-400">
                        <span>Rental Rate (${{ number_format($vehicle->daily_rate, 2) }} × {{ $days }})</span>
                        <span>${{ number_format($total_estimate, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-zinc-600 dark:text-zinc-400">
                        <span>Refundable Deposit</span>
                        <span>${{ number_format($deposit, 2) }}</span>
                    </div>
                    <flux:separator />
                    <div class="flex justify-between font-bold text-xl text-zinc-900 dark:text-white">
                        <span>Total Due</span>
                        <span>${{ number_format($total_estimate + $deposit, 2) }}</span>
                    </div>
                </div>

                <div class="mb-8">
                    <flux:radio.group wire:model="payment_type" label="Payment Method" variant="segmented">
                        <flux:radio value="Credit Card" label="Credit Card" />
                        <flux:radio value="Cash" label="Cash" />
                        <flux:radio value="Direct Deposit" label="Direct Deposit" />
                    </flux:radio.group>
                </div>

                <!--
                  When clicked, this button triggers wire:submit on the form.
                  Alpine intercepts the click first (@click) to extract the canvas image data
                  and update the Livewire property ($wire.set) before it submits.
                -->
                <flux:button type="submit" variant="primary" class="w-full" @click="saveSignature">
                    Confirm & Pay
                </flux:button>
                <p class="text-xs text-center text-zinc-400 mt-4 flex items-center justify-center gap-1">
                    <flux:icon.lock-closed variant="micro" /> Secure mock transaction
                </p>
            </div>
        </div>
    </form>
</div>

<!--
  Alpine.js component script for handling the HTML5 Canvas drawing.
  We put it outside the main div or inside an x-data block.
-->
<script defer>
    document.addEventListener('alpine:init', () => {
        console.log('initiated');
        Alpine.data('signaturePad', () => ({
            isDrawing: false,
            context: null,
            signatureData: '',

            init() {
                // Get the 2D context of the canvas to draw paths
                this.context = this.$refs.canvas.getContext('2d');
                this.context.lineWidth = 2;
                this.context.lineCap = 'round';
                this.context.strokeStyle = '#000'; // Black ink
            },

            // Get exact coordinates accounting for canvas offset and scrolling
            getCoordinates(event) {
                const rect = this.$refs.canvas.getBoundingClientRect();
                const clientX = event.touches ? event.touches[0].clientX : event.clientX;
                const clientY = event.touches ? event.touches[0].clientY : event.clientY;
                return {
                    x: clientX - rect.left,
                    y: clientY - rect.top
                };
            },

            startDrawing(event) {
                this.isDrawing = true;
                const {
                    x,
                    y
                } = this.getCoordinates(event);
                this.context.beginPath();
                this.context.moveTo(x, y);
            },

            draw(event) {
                if (!this.isDrawing) return;
                const {
                    x,
                    y
                } = this.getCoordinates(event);
                this.context.lineTo(x, y);
                this.context.stroke();
            },

            stopDrawing() {
                this.isDrawing = false;
            },

            clear() {
                // Wipe the canvas clean
                this.context.clearRect(0, 0, this.$refs.canvas.width, this.$refs.canvas.height);
                this.signatureData = '';
                this.$wire.set('renter_signature', '');
            },

            saveSignature() {
                console.log('saveSignature called');
                // Convert the canvas to a base64 PNG string
                // We check if it's blank by comparing to an empty canvas (optional advanced check)
                this.signatureData = this.$refs.canvas.toDataURL('image/png');

                // Explicitly sync the base64 string to the Livewire component property 
                // before the form submits.
                this.$wire.set('renter_signature', this.signatureData);
            }
        }))
    })
</script>
