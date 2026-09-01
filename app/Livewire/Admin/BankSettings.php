<?php

namespace App\Livewire\Admin;

use App\Models\Setting;
use Flux;
use Livewire\Component;

class BankSettings extends Component
{
    public $bank_details;

    public function mount()
    {
        $setting = Setting::where('key', 'bank_details')->first();
        $this->bank_details = $setting ? $setting->value : '';
    }

    public function save()
    {
        $this->validate([
            'bank_details' => 'required|string|max:2000',
        ]);

        Setting::updateOrCreate(
            ['key' => 'bank_details'],
            ['value' => $this->bank_details]
        );

        Flux::toast(text: 'Bank settings saved successfully.', variant: 'success');
    }

    public function render()
    {
        return view('livewire.admin.bank-settings')->layout('layouts.app');
    }
}
