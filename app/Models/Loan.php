<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;
use App\Payame\SimplePersonalLoan;

class Loan extends Model
{
    use HasFactory, HasUlids;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'start_date',
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

    public static function makeInstance(float $capital, float $interest_rate, int $payments, string $start_date, string $frequency = 'monthly', string $pay_day = null) : Loan
    {
        // create PersonalLoan
        $personalLoan = new SimplePersonalLoan($capital, $interest_rate, $payments, $start_date);
        $loan = new Loan();
        $loan->capital = $capital;
        $loan->initial_capital = $capital;
        $loan->interest_rate = $interest_rate;
        $loan->payments = $payments;
        $loan->payments_remaining = $payments;
        $loan->payments_received = 0;
        $loan->payments_overdue = 0;
        $loan->quota = $personalLoan->calculateMonthlyPayment();
        $loan->setDateInfo($start_date, $personalLoan->getPayoffDate(), $frequency, $pay_day);
        return $loan;
    }

    public function setDateInfo(string $start_date, string $end_date, string $frequency, string $pay_day = null)
    {
        $this->start_date = $start_date;
        $this->frequency = $frequency;
        $this->end_date = $end_date;
        $this->pay_day = $pay_day;
    }

    /**
     *
     */
    public static function calculateEndDate(string $start_date, int $payments, string $frequency = 'monthly')
    {
        if( $frequency == 'monthly' && $payments > 0 ) {
            $end_date = Carbon::createFromFormat('Y-m-d', $start_date);
            $end_date->addMonths($payments);
            return $end_date->toDateString();
        }
        return null;
    }

}
