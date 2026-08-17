<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;

    protected $fillable = [
        'order_id',
        'amount',
        'payment_method',
        'gateway_reference',
        'status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
