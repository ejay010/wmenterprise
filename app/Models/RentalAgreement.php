<?php

namespace App\Models;

use Database\Factories\RentalAgreementFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class RentalAgreement extends Model
{
    /** @use HasFactory<RentalAgreementFactory> */
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'vehicle_id',
        'first_name',
        'last_name',
        'date_of_birth',
        'drivers_license',
        'drivers_license_image',
        'address',
        'email',
        'phone',
        'pickup_location',
        'pickup_date',
        'pickup_time',
        'return_location',
        'return_date',
        'return_time',
        'price_per_day',
        'deposit',
        'total_due',
        'payment_type',
        'agreed_to_terms',
        'renter_name',
        'renter_signature',
        'company_representative_name',
        'company_signature',
        'signed_at',
        'status',
    ];

    /**
     * Get the resolved URL for the rental agreement's driver's license image.
     */
    public function getDriversLicenseImageUrlAttribute(): ?string
    {
        if (! $this->drivers_license_image) {
            return null;
        }

        $disk = config('filesystems.default') === 's3' ? 's3' : 'public';

        return Storage::disk($disk)->url($this->drivers_license_image);
    }

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'pickup_date' => 'date',
            'pickup_time' => 'datetime:H:i',
            'return_date' => 'date',
            'return_time' => 'datetime:H:i',
            'agreed_to_terms' => 'boolean',
            'signed_at' => 'date',
        ];
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
