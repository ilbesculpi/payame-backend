<?php

namespace App\Payame;

use Carbon\Carbon;

class SimplePersonalLoan extends PersonalLoan
{

    private float $amount;
    private float $interest_rate;
    private int $terms;
    private string $start_date;

    public function __construct(float $amount, float $interest_rate, int $terms, string $start_date)
    {
        $this->amount = $amount;
        $this->interest_rate = $interest_rate;
        $this->terms = $terms;
        $this->start_date = $start_date;
    }

    public function calculateMonthlyPayment()
    {
        return $this->amount * $this->interest_rate / 100.0;
    }

    public function getPayoffDate() : string
    {
        return Carbon::createFromFormat('Y-m-d', $this->start_date)
            ->addMonths($this->terms)
            ->toDateString();
    }

    public function getPayments()
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $this->start_date);
        $payoffDate = Carbon::createFromFormat('Y-m-d', $this->getPayoffDate());
        $now = Carbon::now();
        $payments = [];
        if( $this->terms === 1 ) {
            $status = $payoffDate->lessThanOrEqualTo($now) ? 'hold' : 'upcoming';
            $payments[] = $this->getPaymentForTerm(1, $payoffDate->toDateString(), $status);
            return $payments;
        }

        $term = 1;
        $startDate->addMonth();
        while( $startDate->lessThanOrEqualTo($payoffDate) ) {
            $status = $startDate->lessThanOrEqualTo($now) ? 'hold' : 'upcoming';
            $payments[] = $this->getPaymentForTerm($term++, $startDate->toDateString(), $status);
            $startDate->addMonth();
        }
        return $payments;
    }

    private function getPaymentForTerm(int $term, string $date, string $status) : array
    {
        return [
            'term' => $term,
            'date' => $date,
            'status' => $status,
            'amount' => $this->amount,
        ];
    }

}
