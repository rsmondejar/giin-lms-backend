<?php

namespace Tests\Traits;

use App\Models\IncorporationDate;
use App\Traits\HolidaysTrait;
use Carbon\Carbon;
use Tests\TestCase;

/**
 * Class HolidaysTraitTest
 * @package Tests\Traits
 */
class HolidaysTraitTest extends TestCase
{
    use HolidaysTrait;

    /**
     * Calculate Holidays Same Year Starting Current Year Every Month 1st Test
     * @test
     * @return void
     */
    public function calculateHolidaysSameYearStartingCurrentYearEveryMonth1stTest(): void
    {
        $incorporationDate = new IncorporationDate();
        for ($month = 1; $month <= 12; $month++) {
            $expected = self::calculateExpectedDays($month);
            $incorporationDate->begin_date = today()->clone()->startOfYear()->addMonths($month - 1)->startOfMonth();
            $days = $this->calculateHolidays($incorporationDate);

            $this->assertEquals((float)$expected, (float)$days);
        }
    }

    /**
     * Calculate Holidays Same Year January 1st Test
     * @test
     * @return void
     */
    public function calculateHolidaysSameYearJanuary1stTest(): void
    {
        $month = 1;
        $expected = self::calculateExpectedDays($month);
        $incorporationDate = new IncorporationDate();
        $incorporationDate->begin_date = today()->startOfYear();
        $days = $this->calculateHolidays($incorporationDate);

        $this->assertEquals((float)$expected, (float)$days);
    }

    /**
     * Calculate Holidays Same Year January 10th Test
     * @test
     * @return void
     */
    public function calculateHolidaysSameYearJanuary10thTest(): void
    {
        $expected = 21.5;
        $incorporationDate = new IncorporationDate();
        $incorporationDate->begin_date = Carbon::create(today()->year, 1, 10);
        $days = $this->calculateHolidays($incorporationDate);

        $this->assertEquals((float)$expected, (float)$days);
    }

    /**
     * Calculate Expected Days
     * @param int $monthNumber Month Number. Example: January is 1.
     * @return float
     */
    private static function calculateExpectedDays(int $monthNumber = 1): float
    {
        $result = round((22 * (12 - ($monthNumber - 1))) / 12, 1);
        $wholeNumber = floor($result);
        $fraction = round($result - $wholeNumber, 1);

        if ($fraction < 0.5) {
            return $wholeNumber;
        }

        return $wholeNumber + 0.5;
    }
}
