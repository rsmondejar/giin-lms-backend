<?php

namespace App\Traits;

use App\Models\IncorporationDate;

trait SeniorityDaysTrait
{
    /** @var float $SENIORITY_DAYS_PER_YEAR */
    public static float $SENIORITY_DAYS_PER_YEAR = 0.5;  // NOSONAR

    /**
     * Calculate SeniorityDays
     * @param IncorporationDate $incorporationDate
     * @return float|int
     */
    public function calculateSeniorityDays(IncorporationDate $incorporationDate): float|int
    {
        $firstDayOfYear = now()->startOfYear();

        $years = $incorporationDate->begin_date->diffInYears($firstDayOfYear, false);

        // Si a 1 de enero ya llevamos un año en la empresa, tendremos derecho a medio día libre por antigüedad
        if ($years < 1) {
            return 0;
        }

        return $years * self::$SENIORITY_DAYS_PER_YEAR;
    }

    /**
     * Calculate SeniorityDays Next Year
     * @param IncorporationDate $incorporationDate
     * @return float|int
     */
    public function calculateSeniorityDaysNextYear(IncorporationDate $incorporationDate): float|int
    {
        $firstDayOfYear = now()->addYear()->startOfYear();
        $years = $incorporationDate->begin_date->diffInYears($firstDayOfYear, false);

        // Si a 1 de enero ya llevamos un año en la empresa, tendremos derecho a medio día libre por antigüedad
        if ($years < 1) {
            return 0;
        }

        return $years * self::$SENIORITY_DAYS_PER_YEAR;
    }
}
