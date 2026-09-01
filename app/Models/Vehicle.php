<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\VehicleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    /** @use HasFactory<VehicleFactory> */
    use HasFactory;

    protected $fillable = [
        'class',
        'gearbox',
        'year',
        'color',
        'license_plate',
        'make',
        'model',
        'max_passengers',
        'fuel_type',
        'daily_rate',
        'status',
        'description',
    ];

    public function images()
    {
        return $this->hasMany(VehicleImage::class);
    }

    public function featuredImage()
    {
        return $this->hasOne(VehicleImage::class)->where('is_featured', true);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function blackoutDates()
    {
        return $this->hasMany(BlackoutDate::class);
    }

    /**
     * Check if the vehicle is available for the given date range.
     *
     * @param  string|Carbon  $startDate
     * @param  string|Carbon  $endDate
     */
    public function isAvailableForDates($startDate, $endDate, ?int $excludeOrderId = null): bool
    {
        if ($this->status !== 'available') {
            return false;
        }

        $start = Carbon::parse($startDate)->format('Y-m-d');
        $end = Carbon::parse($endDate)->format('Y-m-d');

        // Check for conflicting orders
        $hasOrderConflict = $this->orders()
            ->where('status', '!=', 'cancelled')
            ->when($excludeOrderId, fn ($query) => $query->where('id', '!=', $excludeOrderId))
            ->where(function ($query) use ($start, $end) {
                $query->where('start_date', '<=', $end)
                    ->where('end_date', '>=', $start);
            })
            ->exists();

        if ($hasOrderConflict) {
            return false;
        }

        // Check for blackout dates (per-vehicle or platform-wide)
        $hasBlackoutConflict = BlackoutDate::forVehicle($this->id)
            ->where(function ($query) use ($start, $end) {
                $query->where('start_date', '<=', $end)
                    ->where('end_date', '>=', $start);
            })
            ->exists();

        return ! $hasBlackoutConflict;
    }

    /**
     * Get all unavailable date ranges for this vehicle (orders + blackout dates).
     *
     * @return array<int, array{from: string, to: string, type: string, reason?: string}>
     */
    public function getUnavailableDateRanges(): array
    {
        $ranges = [];

        // 1. Existing booked orders
        $orders = $this->orders()
            ->where('status', '!=', 'cancelled')
            ->where('end_date', '>=', now()->toDateString())
            ->get();

        foreach ($orders as $order) {
            $ranges[] = [
                'from' => $order->start_date->format('Y-m-d'),
                'to' => $order->end_date->format('Y-m-d'),
                'type' => 'booked',
            ];
        }

        // 2. Blackout dates (vehicle specific + platform-wide)
        $blackouts = BlackoutDate::forVehicle($this->id)
            ->where('end_date', '>=', now()->toDateString())
            ->get();

        foreach ($blackouts as $blackout) {
            $ranges[] = [
                'from' => $blackout->start_date->format('Y-m-d'),
                'to' => $blackout->end_date->format('Y-m-d'),
                'type' => 'blackout',
                'reason' => $blackout->reason ?? ($blackout->isPlatformWide() ? 'Platform Closure' : 'Vehicle Maintenance'),
            ];
        }

        return $ranges;
    }
}
