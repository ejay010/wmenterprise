<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlackoutDate extends Model
{
    protected $fillable = [
        'vehicle_id',
        'start_date',
        'end_date',
        'reason',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function isPlatformWide(): bool
    {
        return is_null($this->vehicle_id);
    }

    public function scopePlatformWide($query)
    {
        return $query->whereNull('vehicle_id');
    }

    public function scopeForVehicle($query, int $vehicleId)
    {
        return $query->where(function ($q) use ($vehicleId) {
            $q->whereNull('vehicle_id')
                ->orWhere('vehicle_id', $vehicleId);
        });
    }
}
