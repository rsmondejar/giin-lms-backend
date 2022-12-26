<?php

namespace RefineriaWeb\RWLms\Traits;

use RefineriaWeb\RWEmployees\Models\IncorporationDate;

trait SeniorityDaysTrait
{
    /**
     * Calculate SeniorityDays
     * @param IncorporationDate $incorporationDate
     * @return float|int
     */
    public function calculateSeniorityDays(IncorporationDate $incorporationDate): float|int
    {
        $from = $incorporationDate->begin_date->startOfYear();
        $now = now();

        return $now->diffInYears($from) / 2;
    }

    /**
     * Calculate SeniorityDays Next Year
     * @param IncorporationDate $incorporationDate
     * @return float|int
     */
    public function calculateSeniorityDaysNextYear(IncorporationDate $incorporationDate): float|int
    {
        $from = $incorporationDate->begin_date->startOfYear();
        $now = now()->addYear();

        return $now->diffInYears($from) / 2;
    }
}
