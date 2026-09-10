<div class="bg-white p-8 sm:p-10 rounded-2xl border border-zinc-200 shadow-sm">
    <div class="mb-8">
        <flux:heading size="xl" class="text-[#0a192f] font-extrabold mb-1">
            Send Us a Message
        </flux:heading>
        <p class="text-xs sm:text-sm text-zinc-500">
            Fill out the form below and our team will be notified directly.
        </p>
    </div>

    @if ($submitted)
        <!-- Success State -->
        <div class="p-6 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 space-y-4">
            <div class="flex items-start gap-3">
                <div class="w-9 h-9 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 mt-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-base text-emerald-950">Message Sent Successfully!</h3>
                    <p class="text-xs sm:text-sm text-emerald-800 mt-1 leading-relaxed">
                        Thank you for reaching out to W Major Enterprises. Your inquiry has been forwarded directly to our administrator's inbox. We will get back to you promptly.
                    </p>
                    <p class="text-xs text-emerald-700 mt-2">
                        Need immediate assistance? You can also reach us directly at <a href="tel:242-376-1454" class="font-bold underline">(242) 376-1454</a>.
                    </p>
                </div>
            </div>

            <div class="pt-2 border-t border-emerald-200/80">
                <button type="button" wire:click="sendAnother"
                    class="text-xs font-semibold text-emerald-800 hover:text-emerald-950 underline focus:outline-none cursor-pointer">
                    Send another inquiry
                </button>
            </div>
        </div>
    @else
        <!-- Contact Form -->
        <form wire:submit="submit" class="space-y-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <flux:field>
                    <flux:label class="text-xs font-semibold uppercase tracking-wider text-zinc-600">
                        Full Name <span class="text-rose-500">*</span>
                    </flux:label>
                    <flux:input wire:model="name" type="text" placeholder="e.g. John Doe" />
                    <flux:error name="name" />
                </flux:field>

                <flux:field>
                    <flux:label class="text-xs font-semibold uppercase tracking-wider text-zinc-600">
                        Email Address <span class="text-rose-500">*</span>
                    </flux:label>
                    <flux:input wire:model="email" type="email" placeholder="e.g. john@example.com" />
                    <flux:error name="email" />
                </flux:field>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <flux:field>
                    <flux:label class="text-xs font-semibold uppercase tracking-wider text-zinc-600">
                        Phone / WhatsApp (Optional)
                    </flux:label>
                    <flux:input wire:model="phone" type="tel" placeholder="+1 (242) 555-0123" />
                    <flux:error name="phone" />
                </flux:field>

                <flux:field>
                    <flux:label class="text-xs font-semibold uppercase tracking-wider text-zinc-600">
                        Preferred Airport Hub
                    </flux:label>
                    <flux:select wire:model="airport">
                        <option value="Rock Sound International (RSD)">Rock Sound International (RSD)</option>
                        <option value="Governor's Harbour International (GHB)">Governor's Harbour International (GHB)</option>
                        <option value="Other / Island Delivery">Other / Island Delivery</option>
                    </flux:select>
                    <flux:error name="airport" />
                </flux:field>
            </div>

            <flux:field>
                <flux:label class="text-xs font-semibold uppercase tracking-wider text-zinc-600">
                    Your Message or Inquiry <span class="text-rose-500">*</span>
                </flux:label>
                <flux:textarea wire:model="message" rows="5"
                    placeholder="Let us know your travel dates, vehicle preference, or any questions you may have..." />
                <flux:error name="message" />
            </flux:field>

            <div>
                <flux:button type="submit" variant="primary"
                    class="w-full sm:w-auto bg-accent text-white px-8 py-3 rounded-xl font-bold transition disabled:opacity-50"
                    wire:loading.attr="disabled">
                    <span wire:loading.remove>Send Message</span>
                    <span wire:loading class="inline-flex items-center gap-2">
                        <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        <span>Sending to Admin...</span>
                    </span>
                </flux:button>
            </div>
        </form>
    @endif
</div>
