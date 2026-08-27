<div class="max-w-3xl mx-auto space-y-6 py-8">
    <flux:heading size="xl">Bank Settings for Direct Deposit</flux:heading>
    
    <flux:card>
        <form wire:submit="save" class="space-y-6">
            <p class="text-sm text-zinc-500">
                Enter your banking details below. Customers will see this information when they choose the "Direct Deposit" payment method during checkout. They will be instructed to make a payment and upload a screenshot of the receipt.
            </p>

            <flux:textarea 
                wire:model="bank_details" 
                label="Banking Details (Account Name, Account Number, Branch, etc.)" 
                rows="6" 
                required 
            />

            <div class="flex justify-end gap-3 pt-4">
                <flux:button type="submit" variant="primary">Save Settings</flux:button>
            </div>
        </form>
    </flux:card>
</div>
