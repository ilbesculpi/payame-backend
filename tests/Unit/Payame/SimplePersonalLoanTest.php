<?php

namespace Tests\Unit\Payame;

use PHPUnit\Framework\TestCase;
use App\Payame\SimplePersonalLoan;

class SimplePersonalLoanTest extends TestCase
{

    public function test_loan_montly_amount_12_pct()
    {
        $loan = new SimplePersonalLoan(300.0, 12.0, 12, '2018-06-01');
        $this->assertEquals(36.0, $loan->calculateMonthlyPayment());
    }

    public function test_loan_montly_amount_10_pct()
    {
        $loan = new SimplePersonalLoan(0, 0, 0, '2018-06-01');
        $this->assertEquals(0, $loan->calculateMonthlyPayment());
    }

    public function test_loan_payoff_date_1_term()
    {
        $loan = new SimplePersonalLoan(1000, 10.0, 1, '2020-05-06');
        $this->assertEquals('2020-06-06', $loan->getPayoffDate());
    }

    public function test_loan_payoff_date_12_terms()
    {
        $loan = new SimplePersonalLoan(1000, 10.0, 12, '2024-06-01');
        $this->assertEquals('2025-06-01', $loan->getPayoffDate());
    }

    public function test_payments_1_term()
    {
        $loan = new SimplePersonalLoan(1000, 10.0, 1, '2022-05-06');
        $payments = $loan->getPayments();
        $this->assertEquals(1, count($payments));
        $payment = $payments[0];
        $this->assertEquals(1, $payment['term']);
        $this->assertEquals('2022-06-06', $payment['date']);
    }

    public function test_payments_6_terms()
    {
        $termsCount = 6;
        $loan = new SimplePersonalLoan(1000, 10.0, $termsCount, '2022-09-11');
        $expected = ['2022-10-11', '2022-11-11', '2022-12-11', '2023-01-11', '2023-02-11', '2023-03-11'];
        $payments = $loan->getPayments();
        $this->assertEquals($termsCount, count($payments));
        foreach( $payments as $index => $payment ) {
            $this->assertEquals($index + 1, $payment['term']);
            $this->assertEquals($expected[$index], $payment['date']);
        }
    }

}
