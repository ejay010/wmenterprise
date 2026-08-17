<?php

namespace App\Livewire\Admin;

use App\Models\RentalAgreement;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * The AgreementList component allows administrators to view all submitted rental agreements.
 */
class AgreementList extends Component
{
    // Include the WithPagination trait to handle large lists of agreements across multiple pages.
    use WithPagination;

    public function render()
    {
        // Fetch all rental agreements, eagerly loading the associated vehicle and user (if any) to prevent N+1 query issues.
        // We order by the newest creations first.
        $agreements = RentalAgreement::with(['vehicle', 'user'])->latest()->paginate(15);

        return view('livewire.admin.agreement-list', [
            'agreements' => $agreements,
        ])->layout('layouts.app');
    }
}
