<?php

namespace App\Livewire\Admin;

use App\Models\BlackoutDate;
use App\Models\Vehicle;
use Flux;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Admin component to manage per-vehicle and platform-wide blackout dates.
 */
class BlackoutDates extends Component
{
    use WithPagination;

    // Form inputs
    public $vehicle_id = ''; // Empty string = platform-wide, otherwise vehicle ID

    public $start_date;

    public $end_date;

    public $reason = '';

    // Filter
    public $filter_vehicle = '';

    public function mount()
    {
        $this->start_date = now()->addDay()->format('Y-m-d');
        $this->end_date = now()->addDays(2)->format('Y-m-d');
    }

    public function save()
    {
        $this->validate([
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'nullable|string|max:255',
        ]);

        BlackoutDate::create([
            'vehicle_id' => ! empty($this->vehicle_id) ? $this->vehicle_id : null,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'reason' => $this->reason ?: null,
        ]);

        // Reset form inputs
        $this->reset(['reason']);
        $this->vehicle_id = '';
        $this->start_date = now()->addDay()->format('Y-m-d');
        $this->end_date = now()->addDays(2)->format('Y-m-d');

        Flux::toast(text: 'Blackout dates successfully added.', variant: 'success');
    }

    public function deleteBlackoutDate(int $id)
    {
        $blackout = BlackoutDate::find($id);
        if ($blackout) {
            $blackout->delete();
            Flux::toast(text: 'Blackout date removed.', variant: 'success');
        }
    }

    public function render()
    {
        $vehicles = Vehicle::orderBy('make')->orderBy('model')->get();

        $blackouts = BlackoutDate::with('vehicle')
            ->when($this->filter_vehicle === 'platform', fn ($q) => $q->whereNull('vehicle_id'))
            ->when(is_numeric($this->filter_vehicle), fn ($q) => $q->where('vehicle_id', $this->filter_vehicle))
            ->orderBy('start_date', 'desc')
            ->paginate(15);

        return view('livewire.admin.blackout-dates', [
            'vehicles' => $vehicles,
            'blackouts' => $blackouts,
        ])->layout('layouts.app');
    }
}
