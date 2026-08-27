<?php

namespace App\Models;

use Database\Factories\TransactionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /** @use HasFactory<TransactionFactory> */
    use HasFactory;

    protected $fillable = [
        'order_id',
        'amount',
        'payment_method',
        'gateway_reference',
        'status',
        'bank_receipt_image',
        'bank_transaction_number',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
