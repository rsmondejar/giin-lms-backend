<?php

namespace Tests\Traits;

use App\Models\IncorporationDate;
use App\Traits\SeniorityDaysTrait;
use Tests\TestCase;

/**
 * Class SeniorityDaysTraitTest
 * @package Tests\Traits
 */
class SeniorityDaysTraitTest extends TestCase
{
    use SeniorityDaysTrait;

    /**
     * Calculate Seniority Days Same Year Test
     * @test
     * @return void
     */
    public function calculateSeniorityDaysSameYearTest(): void
    {
        $expected = 0;
        $incorporationDate = new IncorporationDate();
        $incorporationDate->begin_date = today()->startOfYear()->addMonth();
        $days = $this->calculateSeniorityDays($incorporationDate);

        $this->assertEquals((float)$expected, (float)$days);
    }

    /**
     * Calculate Seniority Days Difference Lower Than One Year
     * @test
     * @return void
     */
    public function calculateSeniorityDaysDifferenceLowerThanOneYearTest(): void
    {
        $expected = 0;
        $incorporationDate = new IncorporationDate();
        $incorporationDate->begin_date = today()->subMonths(11);
        $days = $this->calculateSeniorityDays($incorporationDate);

        $this->assertEquals((float)$expected, (float)$days);
    }

    /**
     * Calculate Seniority Days Difference Exactly One Year
     * @test
     * @return void
     */
    public function calculateSeniorityDaysDifferenceExactlyOneYearTest(): void
    {
        $expected = 0;
        $incorporationDate = new IncorporationDate();
        $incorporationDate->begin_date = today()->subYear();
        $days = $this->calculateSeniorityDays($incorporationDate);

        $this->assertEquals((float)$expected, (float)$days);
    }

    /**
     * Calculate Seniority Days Difference Starting January First
     * @test
     * @return void
     */
    public function calculateSeniorityDaysDifferenceStartingJanuaryFirstTest(): void
    {
        $expected = 0;
        $incorporationDate = new IncorporationDate();
        $incorporationDate->begin_date = today()->startOfYear();
        $days = $this->calculateSeniorityDays($incorporationDate);

        $this->assertEquals((float)$expected, (float)$days);
    }

    /**
     * Calculate Seniority Days Difference Starting January First Last Year
     * @test
     * @return void
     */
    public function calculateSeniorityDaysDifferenceStartingJanuaryFirstLastYearTest(): void
    {
        $expected = self::$SENIORITY_DAYS_PER_YEAR;
        $incorporationDate = new IncorporationDate();
        $incorporationDate->begin_date = today()->startOfYear()->subYear();
        $days = $this->calculateSeniorityDays($incorporationDate);

        $this->assertEquals((float)$expected, (float)$days);
    }

    /**
     * Calculate Seniority Days Difference More Than One Year
     * @test
     * @return void
     */
    public function calculateSeniorityDaysDifferenceMoreThanOneYearTest(): void
    {
        $years = 1;
        $expected = self::$SENIORITY_DAYS_PER_YEAR * $years;
        $this->assertEquals((float)$expected, (float)$this->calculateDifferenceYears($years));
    }

    /**
     * Calculate Seniority Days Difference More Than Two Year
     * @test
     * @return void
     */
    public function calculateSeniorityDaysDifferenceMoreThanTwoYearsTest(): void
    {
        $years = 2;
        $expected = self::$SENIORITY_DAYS_PER_YEAR * $years;
        $this->assertEquals((float)$expected, (float)$this->calculateDifferenceYears($years));
    }

    /**
     * Calculate Seniority Days Difference More Than Five Year
     * @test
     * @return void
     */
    public function calculateSeniorityDaysDifferenceMoreThanFiveYearsTest(): void
    {
        $years = 5;
        $expected = self::$SENIORITY_DAYS_PER_YEAR * $years;
        $this->assertEquals((float)$expected, (float)$this->calculateDifferenceYears($years));
    }

    /**
     * Calculate Seniority Days Difference More Than Ten Year
     * @test
     * @return void
     */
    public function calculateSeniorityDaysDifferenceMoreThanTenYearsTest(): void
    {
        $years = 10;
        $expected = self::$SENIORITY_DAYS_PER_YEAR * $years;
        $this->assertEquals((float)$expected, (float)$this->calculateDifferenceYears($years));
    }

    private function calculateDifferenceYears(int $years): float|int
    {
        $incorporationDate = new IncorporationDate();
        $incorporationDate->begin_date = today()->startOfYear()->subYears($years)->subMonth();
        return (float)$this->calculateSeniorityDays($incorporationDate);
    }
}
