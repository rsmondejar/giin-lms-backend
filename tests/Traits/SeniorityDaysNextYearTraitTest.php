<?php

namespace Tests\Traits;

use App\Models\IncorporationDate;
use App\Traits\SeniorityDaysTrait;
use Carbon\Carbon;
use Tests\TestCase;

/**
 * Class SeniorityDaysNextYearTraitTest
 * @package Tests\Traits
 */
class SeniorityDaysNextYearTraitTest extends TestCase
{
    use SeniorityDaysTrait;

    /**
     * Calculate Seniority Days Next Year Starting Current Year Is January 1st
     * @test
     * @return void
     */
    public function calculateSeniorityDaysNextYearStartingCurrentYearIsJanuary1stTest(): void
    {
        $years = 1;
        $expected = self::$SENIORITY_DAYS_PER_YEAR * $years;
        $incorporationDate = new IncorporationDate();
        $incorporationDate->begin_date = Carbon::create(today()->year);
        $days = $this->calculateSeniorityDaysNextYear($incorporationDate);

        $this->assertEquals((float)$expected, (float)$days);
    }

    /**
     * Calculate Seniority Days Next Year Starting Current Year Not January 1st
     * @test
     * @return void
     */
    public function calculateSeniorityDaysNextYearStartingCurrentYearNotJanuary1stTest(): void
    {
        $years = 0;
        $expected = self::$SENIORITY_DAYS_PER_YEAR * $years;
        $incorporationDate = new IncorporationDate();
        for ($i = 1; $i <= 12; $i++) {
            $incorporationDate->begin_date = Carbon::create(today()->year, $i, 2);
            $days = $this->calculateSeniorityDaysNextYear($incorporationDate);

            $this->assertEquals((float)$expected, (float)$days);
        }
    }

    /**
     * Calculate Seniority Days Next Year Starting Last Year Is January 1st
     * @test
     * @return void
     */
    public function calculateSeniorityDaysNextYearStartingLastYearIsJanuary1stTest(): void
    {
        $years = 2;
        $expected = self::$SENIORITY_DAYS_PER_YEAR * $years;
        $incorporationDate = new IncorporationDate();
        $incorporationDate->begin_date = Carbon::create(today()->subYears($years - 1)->year);
        $days = $this->calculateSeniorityDaysNextYear($incorporationDate);

        $this->assertEquals((float)$expected, (float)$days);
    }

    /**
     * Calculate Seniority Days Next Year Starting Current Year Not January 1st
     * @test
     * @return void
     */
    public function calculateSeniorityDaysNextYearStartingLastYearNotJanuary1stTest(): void
    {
        $years = 1;
        $expected = self::$SENIORITY_DAYS_PER_YEAR * $years;
        $incorporationDate = new IncorporationDate();
        for ($i = 1; $i <= 12; $i++) {
            $incorporationDate->begin_date = Carbon::create(today()->subYears($years)->year, $i, 2);
            $days = $this->calculateSeniorityDaysNextYear($incorporationDate);

            $this->assertEquals((float)$expected, (float)$days);
        }
    }

    /**
     * Calculate Seniority Days Next Year Starting Last Two Years Not January 1st
     * @test
     * @return void
     */
    public function calculateSeniorityDaysNextYearStartingLastTwoYearsNotJanuary1stTest(): void
    {
        $years = 2;
        $expected = self::$SENIORITY_DAYS_PER_YEAR * $years;
        $incorporationDate = new IncorporationDate();
        for ($i = 1; $i <= 12; $i++) {
            $incorporationDate->begin_date = Carbon::create(today()->subYears($years)->year, $i, 2);
            $days = $this->calculateSeniorityDaysNextYear($incorporationDate);

            $this->assertEquals((float)$expected, (float)$days);
        }
    }

    /**
     * Calculate Seniority Days Difference More Than One Year
     * @test
     * @return void
     */
    public function calculateSeniorityDaysNextYearDifferenceMoreThanOneYearTest(): void
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
    public function calculateSeniorityDaysNextYearDifferenceMoreThanTwoYearsTest(): void
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
    public function calculateSeniorityDaysNextYearDifferenceMoreThanFiveYearsTest(): void
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
    public function calculateSeniorityDaysNextYearDifferenceMoreThanTenYearsTest(): void
    {
        $years = 10;
        $expected = self::$SENIORITY_DAYS_PER_YEAR * $years;
        $this->assertEquals((float)$expected, (float)$this->calculateDifferenceYears($years));
    }

    private function calculateDifferenceYears(int $years): float|int
    {
        $incorporationDate = new IncorporationDate();
        $incorporationDate->begin_date = today()->startOfYear()->subYears($years)->addDay();
        return (float)$this->calculateSeniorityDaysNextYear($incorporationDate);
    }
}
