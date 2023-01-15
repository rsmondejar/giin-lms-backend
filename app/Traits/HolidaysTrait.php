<?php

namespace App\Traits;

use App\Models\IncorporationDate;
use App\Models\User;
use App\Models\UserHoliday;

/**
 * Trait HolidaysTrait
 * @package App\Traits
 */
trait HolidaysTrait
{
    use SeniorityDaysTrait;

    /** @var int $DEFAULT_DAYS_PER_YEAR */
    public static int $DEFAULT_DAYS_PER_YEAR = 22;

    /**
     * Calculate Holidays
     * @param IncorporationDate $incorporationDate
     * @return float
     */
    public function calculateHolidays(IncorporationDate $incorporationDate): float
    {
        $startDate = $incorporationDate->begin_date;
        $nextYear = $incorporationDate->begin_date->clone()->startOfYear()->addYear();

        $missingDaysOfTheYear = $startDate->diffInDays($nextYear);

        $result = (self::$DEFAULT_DAYS_PER_YEAR * $missingDaysOfTheYear) / $startDate->clone()->daysInYear;
        $wholeNumber = floor($result);
        $fraction = round($result - $wholeNumber, 1);

        if ($fraction < 0.5) {
            return $wholeNumber;
        }

        return $wholeNumber + 0.5;
    }

    /**
     * Calculate Holidays
     * @param IncorporationDate $incorporationDate
     * @return float
     */
    public function calculateHolidaysNextYear(IncorporationDate $incorporationDate): float
    {
        $startDate = $incorporationDate->begin_date->startOfYear();
        $nextYear = $incorporationDate->begin_date->clone()->startOfYear()->addYear();

        $missingDaysOfTheYear = $startDate->diffInDays($nextYear);

        $result = (self::$DEFAULT_DAYS_PER_YEAR * $missingDaysOfTheYear) / $startDate->clone()->daysInYear;
        $wholeNumber = floor($result);
        $fraction = round($result - $wholeNumber, 1);

        if ($fraction < 0.5) {
            return $wholeNumber;
        }

        return $wholeNumber + 0.5;
    }

    /**
     * Generate User Holidays Current Year For User
     * @param User $user
     * @return UserHoliday|null
     */
    public function generateUserHolidaysCurrentYearForUser(User $user): ?UserHoliday
    {
        /** @var IncorporationDate $oldestIncorporationDate */
        $oldestIncorporationDate = $user->incorporationDates()->isNotIntern()->oldest()->first();

        $year = now()->year;

        if (is_null($oldestIncorporationDate)) {
            $holidays = 0;
            $seniorityDays = 0;
        } else {
            if ($oldestIncorporationDate->begin_date->year < $year) {
                $holidays = self::$DEFAULT_DAYS_PER_YEAR;
            } else {
                $holidays = $this->calculateHolidays($oldestIncorporationDate);
            }
            $seniorityDays = $this->calculateSeniorityDays($oldestIncorporationDate);
        }

        $userHoliday = UserHoliday::where('year', $year)
            ->where('user_id', $user->id)
            ->first();

        if (is_null($userHoliday)) {
            $userHoliday = UserHoliday::create([
                'user_id' => $user->id,
                'year' => $year,
                'holidays' => $holidays,
                'seniority_days' => $seniorityDays,
                'extra' => 0
            ]);
        } else {
            $userHoliday->update([
                'holidays' => $holidays,
                'seniority_days' => $seniorityDays,
            ]);
        }

        return $userHoliday;
    }

    /**
     * Generate User Holidays Next Year For User
     * @param User $user
     * @return UserHoliday|null
     */
    public function generateUserHolidaysNextYearForUser(User $user): ?UserHoliday
    {
        $oldestIncorporationDate = $user->incorporationDates()->isNotIntern()->oldest()->first();

        $year = now()->addYear()->year;

        if (is_null($oldestIncorporationDate)) {
            $holidays = 0;
            $seniorityDays = 0;
        } else {
            if ($oldestIncorporationDate->begin_date->year < $year) {
                $holidays = self::$DEFAULT_DAYS_PER_YEAR;
            } else {
                $holidays = $this->calculateHolidaysNextYear($oldestIncorporationDate);
            }
            $seniorityDays = $this->calculateSeniorityDaysNextYear($oldestIncorporationDate);
        }

        $userHoliday = UserHoliday::where('year', $year)
            ->where('user_id', $user->id)
            ->first();

        if (is_null($userHoliday)) {
            $userHoliday = UserHoliday::create([
                'user_id' => $user->id,
                'year' => $year,
                'holidays' => $holidays,
                'seniority_days' => $seniorityDays,
                'extra' => 0
            ]);
        } else {
            $userHoliday->update([
                'holidays' => $holidays,
                'seniority_days' => $seniorityDays,
            ]);
        }

        return $userHoliday;
    }
}
