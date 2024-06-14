<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
    use HasFactory, HasUlids;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'start_date',
        'end_date',
        'method',
        'interest_rate',
        'method',
        'capital',
        'quota',
        'frequency',
        'pay_day',
        'payments',
        'status',
    ];

    /**
     * Get the user that owns the comment.
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function setInitalValues()
    {
        $this->initial_capital = $this->capital;
        $this->payments_remaining = $this->payments;
        $this->payments_received = 0;
        $this->payments_overdue = 0;
    }

}
