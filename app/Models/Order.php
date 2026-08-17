<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vehicle_id',
        'guest_first_name',
        'guest_last_name',
        'guest_email',
        'guest_phone',
        'start_date',
        'end_date',
        'total_amount',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function rentalAgreement()
    {
        return $this->hasOne(RentalAgreement::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
