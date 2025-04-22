<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;
use App\Payame\SimplePersonalLoan;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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
        'capital',
        'frequency',
        'pay_day',
        'terms',
    ];

    /**
     * Get the user that owns the comment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function associate(): BelongsToMany
    {
        return $this->belongsToMany(Associate::class, 'loans_associates')
            ->withPivot('percentage');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public static function getUserActiveLoans($user_id)
    {
        return Self::where(['user_id' => $user_id, 'status' => 'active'])
            ->with('customer');
    }

    public static function makeInstanceSimpleInterest(float $amount, float $interest_rate, int $terms = 12, string $terms_unit = 'months', string $start_date, string $pay_day = '1'): Loan
    {
        // create PersonalLoan
        $personalLoan = new SimplePersonalLoan(
            $amount,
            $interest_rate,
            $terms,
            $start_date
        );
        $loan = new Loan();
        $loan->initial_amount = $amount;
        $loan->current_amount = $amount;
        $loan->interest_rate = $interest_rate;
        $loan->interest_method = 'simple';
        $loan->terms = $terms;
        $loan->payments_remaining = $terms;
        $loan->payments_received = 0;
        $loan->payments_overdue = 0;
        $loan->payment_amount = $personalLoan->calculatePaymentAmount();
        $loan->terms = $terms;
        $loan->terms_unit = $terms_unit;
        $loan->pay_day = $pay_day;
        $loan->start_date = $start_date;
        $loan->end_date = $personalLoan->getPayoffDate();
        return $loan;
    }

}
