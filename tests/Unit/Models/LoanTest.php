<?php

namespace Tests\Unit\Models;

use PHPUnit\Framework\TestCase;
use App\Models\Loan;

class LoanTest extends TestCase
{
    public function test_makeInstance()
    {
        $loan = Loan::makeInstance(500, 10, 6, '2020-09-15');
        $this->assertInstanceOf(Loan::class, $loan);
        $this->assertNotNull($loan);
    }

    public function test_makeInstance_setEndDate()
    {
        $loan = Loan::makeInstance(500, 10, 6, '2020-09-15');
        $this->assertNotNull($loan->end_date);
        $this->assertEquals('2021-03-15', $loan->end_date);
    }

    public function test_makeInstace_setInterestRate()
    {
        $loan = Loan::makeInstance(1000, 12.0, 6, '2020-06-10');
        $this->assertNotNull($loan->interest_rate);
        $this->assertEquals(12.0, $loan->interest_rate);
    }

    public function test_makeInstance_setQuota()
    {
        $loan = Loan::makeInstance(500, 10, 6, '2020-09-15');
        $this->assertEquals(50, $loan->quota);
        $loan = Loan::makeInstance(1200, 12, 6, '2020-09-15');
        $this->assertEquals(144, $loan->quota);
        $loan = Loan::makeInstance(300, 5.5, 2, '2020-09-15');
        $this->assertEquals(16.5, $loan->quota);
    }

    public function test_makeInstance_setPaymentsInfo()
    {
        $loan = Loan::makeInstance(500, 10, 10, '2020-09-15');
        $this->assertEquals(10, $loan->terms);
        $this->assertEquals(10, $loan->payments_remaining);
        $this->assertEquals(0, $loan->payments_received);
        $this->assertEquals(0, $loan->payments_overdue);
    }

}

