<?php

namespace Tests\Unit;

use App\Calculator\DateTimeCalculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    /**
     * Test days difference calculator, input same two days
     */
    public function test_days_diff_calculator_same_two_days_return_zero_diff(): void
    {
        $days_diff = (new DateTimeCalculator())->days_diff_calculator('2023-03-15T10:15', '2023-03-15T11:15');
        $this->assertEquals(0, $days_diff);
    }

    /**
     * Test weeks difference calculator, input two days in the same week
     */
    public function test_weeks_diff_calculator_two_days_in_the_same_week_return_zero_diff(): void
    {
        $weeks_diff = (new DateTimeCalculator())->weeks_diff_calculator('2023-03-15T10:15', '2023-03-18T11:15');
        $this->assertEquals(0, $weeks_diff);
    }
}
