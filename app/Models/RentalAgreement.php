<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalAgreement extends Model
{
    /** @use HasFactory<\Database\Factories\RentalAgreementFactory> */
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'vehicle_id',
        'first_name',
        'last_name',
        'date_of_birth',
        'drivers_license',
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
