<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory, HasUlids;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'payment_date',
        'payment_method',
        'payment_capital',
        'payment_interest',
        'payment_delay',
        'notes',
        'customer_id',
        'loan_id',
    ];

    protected static function booted()
    {
        static::creating(function($payment) {
            $payment->payment_total = $payment->payment_capital +
                $payment->payment_interest +
                $payment->payment_delay;
        });
        static::updating(function($payment) {
            $payment->payment_total = $payment->payment_capital +
                $payment->payment_interest +
                $payment->payment_delay;
        });
    }

    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loan::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

}
