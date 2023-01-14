<?php

namespace App\Http\Controllers;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use JetBrains\PhpStorm\ArrayShape;
use App\Models\User;
use App\Models\Leave;
use App\Models\LeaveDate;
use App\Models\UserHoliday;

/**
 * Get Request Holidays Metrics Controller
 * @package App\Http\Controllers
 */
class GetRequestHolidaysMetricsController
{
    /**
     * Get Metrics By the User.
     * @param User $user
     * @return array
     */
    #[ArrayShape([
        'sickness_days' => "float", // NOSONAR
        'vacations_days' => "float", // NOSONAR
        'vacations_remaining_days' => "float", // NOSONAR
        'vacations_per_year_days' => "float", // NOSONAR
        'vacations_current_month_days' => "float", // NOSONAR
        'unofficial_leaves_days' => "float", // NOSONAR
        'leaves_of_absence_days' => "float", // NOSONAR
        'seniority_days' => "float", // NOSONAR
        'seniority_remaining_days' => "float", // NOSONAR
        'seniority_per_year_days' => "float", // NOSONAR
        'half_days' => "float", // NOSONAR
        'last_year_vacations_days' => "float", // NOSONAR
        'last_year_vacations_remaining_days' => "float", // NOSONAR
        'last_year_vacations_per_year_days' => "float", // NOSONAR
    ])]
    public static function getMetricsByUser(User $user): array
    {
        return [
            'sickness_days' => self::getSicknessDaysByUser($user),
            'vacations_days' => self::getCurrentVacationsDaysByUser($user),
            'vacations_remaining_days' => self::getCurrentVacationsRemainingDaysByUser($user),
            'vacations_per_year_days' => self::getVacationsPerYearDaysByUser($user),
            'vacations_current_month_days' => self::getCurrentMonthVacationsByUser($user),
            'unofficial_leaves_days' => self::getUnofficialLeavesDaysByUser($user),
            'leaves_of_absence_days' => self::getLeavesOfAbsenceDaysByUser($user),
            'seniority_days' => self::getCurrentSeniorityDaysByUser($user),
            'seniority_remaining_days' => self::getCurrentSeniorityRemainingDaysByUser($user),
            'seniority_per_year_days' => self::getSeniorityPerYearDaysByUser($user),
            'half_days' => self::getHalfDaysByUser($user),
            'last_year_vacations_days' => self::getLastYearVacationsDaysByUser($user),
            'last_year_vacations_remaining_days' => self::getLastYearVacationsRemainingDaysByUser($user),
            'last_year_vacations_per_year_days' => self::getLastYearVacationsPerYearDaysByUser($user),
        ];
    }

    /**
     * Get Sickness Days By User.
     * @param User $user User
     * @return float
     */
    public static function getSicknessDaysByUser(User $user): float
    {
        $leaves = Leave::byUser($user->id)
            ->ofCurrentYearByUserHolidays()
            ->isAllowed()
            ->typeSickness()
            ->withCount(self::withCountDates())
            ->get();

        return self::sumDays($leaves);
    }

    /**
     * Get Current Vacations Days By User.
     * @param User $user User
     * @return float
     */
    public static function getCurrentVacationsDaysByUser(User $user): float
    {
        $leaves = Leave::byUser($user->id)
            ->ofCurrentYearByUserHolidays()
            ->isAllowed()
            ->typeHolidays()
            ->withCount(self::withCountDates())
            ->get();

        return self::sumDays($leaves);
    }

    /**
     * Get Current Vacations Remaining Days By User.
     * @param User $user User
     * @return float
     */
    public static function getCurrentVacationsRemainingDaysByUser(User $user): float
    {
        $used = self::getCurrentVacationsDaysByUser($user);
        $total = self::getVacationsPerYearDaysByUser($user);

        return $total - $used;
    }

    /**
     * Get Current Month Vacations Days By User.
     * @param User $user User
     * @return float
     */
    public static function getCurrentMonthVacationsByUser(User $user): float
    {
        $leaves = Leave::byUser($user->id)
            ->ofCurrentMonth()
            ->isAllowed()
            ->typeHolidays()
            ->withCount(self::withCountDates())
            ->get();

        return self::sumDays($leaves);
    }

    /**
     * Get Vacations Per Year Days By User.
     * @param User $user User
     * @return float
     */
    public static function getVacationsPerYearDaysByUser(User $user): float
    {
        return (float)UserHoliday::byUser($user->id)->ofCurrentYear()->first()?->holidays ?? 0;
    }

    /**
     * Get Last Year Vacations Remaining Days By User.
     * @param User $user User
     * @return float
     */
    public static function getLastYearVacationsRemainingDaysByUser(User $user): float
    {
        $used = self::getLastYearVacationsDaysByUser($user);
        $total = self::getLastYearVacationsPerYearDaysByUser($user);

        return $total - $used;
    }

    /**
     * Get Last Year Vacations Days By User.
     * @param User $user User
     * @return float
     */
    public static function getLastYearVacationsDaysByUser(User $user): float
    {
        $leaves = Leave::byUser($user->id)
            ->ofLastYearByUserHolidays()
            ->isAllowed()
            ->typeHolidays()
            ->withCount(self::withCountDates())
            ->get();

        return self::sumDays($leaves);
    }

    /**
     * Get Last Year Vacations Per Year Days By User.
     * @param User $user User
     * @return float
     */
    public static function getLastYearVacationsPerYearDaysByUser(User $user): float
    {
        return (float)UserHoliday::byUser($user->id)->ofLastYear()->first()?->holidays ?? 0;
    }


    /**
     * Get Next Vacations Remaining Days By User.
     * @param User $user User
     * @return float
     */
    public static function getNextVacationsRemainingDaysByUser(User $user): float
    {
        $used = self::getNextYearVacationsDaysByUser($user);
        $total = self::getNextYearVacationsPerYearDaysByUser($user);

        return $total - $used;
    }

    /**
     * Get Last Year Vacations Days By User.
     * @param User $user User
     * @return float
     */
    public static function getNextYearVacationsDaysByUser(User $user): float
    {
        $leaves = Leave::byUser($user->id)
            ->ofNextYear()
            ->isAllowed()
            ->typeHolidays()
            ->withCount(self::withCountDates())
            ->get();

        return self::sumDays($leaves);
    }

    /**
     * Get Last Year Vacations Per Year Days By User.
     * @param User $user User
     * @return float
     */
    public static function getNextYearVacationsPerYearDaysByUser(User $user): float
    {
        return (float)UserHoliday::byUser($user->id)->ofNextYear()->first()?->holidays ?? 0;
    }

    /**
     * Get Unofficial Leaves Days By User.
     * @param User $user User
     * @return float
     */
    public static function getUnofficialLeavesDaysByUser(User $user): float
    {
        $leaves = Leave::byUser($user->id)
            ->ofCurrentYearByUserHolidays()
            ->isAllowed()
            ->typeUnofficial()
            ->withCount(self::withCountDates())
            ->get();

        return self::sumDays($leaves);
    }

    /**
     * Get Leaves Of Absence Days By User.
     * @param User $user User
     * @return float
     */
    public static function getLeavesOfAbsenceDaysByUser(User $user): float
    {
        $leaves = Leave::byUser($user->id)
            ->ofCurrentYearByUserHolidays()
            ->isAllowed()
            ->typeAbsence()
            ->withCount(self::withCountDates())
            ->get();

        return self::sumDays($leaves);
    }

    /**
     * Get Current Seniority Days By User.
     * @param User $user User
     * @return float
     */
    public static function getCurrentSeniorityDaysByUser(User $user): float
    {
        $leaves = Leave::byUser($user->id)
            ->ofCurrentYear()
            ->isAllowed()
            ->typeSeniority()
            ->withCount(self::withCountDates())
            ->get();

        return self::sumDays($leaves);
    }

    /**
     * Get Current Seniority Remaining Days By User.
     * @param User $user User
     * @return float
     */
    public static function getCurrentSeniorityRemainingDaysByUser(User $user): float
    {
        $used = self::getCurrentSeniorityDaysByUser($user);
        $total = self::getSeniorityPerYearDaysByUser($user);

        return $total - $used;
    }

    /**
     * Get Seniority Per Year Days By User.
     * @param User $user User
     * @return float
     */
    public static function getSeniorityPerYearDaysByUser(User $user): float
    {
        return (float)UserHoliday::byUser($user->id)->ofCurrentYear()->first()?->seniority_days ?? 0;
    }

    /**
     * Get Half Days By User.
     * @param User $user User
     * @return float
     */
    public static function getHalfDaysByUser(User $user): float
    {
        $leaves = Leave::byUser($user->id)
            ->ofCurrentYearByUserHolidays()
            ->isAllowed()
            ->withCount(self::withCountDates())
            ->get();

        return $leaves->sum('half_days_count');
    }

    /**
     * With Count Dates
     * @return Closure[]
     */
    #[ArrayShape([
        'dates as half_days_count' => "\Closure",
        'dates as full_days_count' => "\Closure"
    ])]
    private static function withCountDates(): array
    {
        return [
            'dates as half_days_count' => function (Builder $query) {
                /** @var LeaveDate $query */
                $query->isActive()->isHalfDay();
            },
            'dates as full_days_count' => function (Builder $query) {
                /** @var LeaveDate $query */
                $query->isActive()->isFullDay();
            },
        ];
    }

    /**
     * Sum Leaves Days
     * @param Collection $leaves
     * @return float
     */
    private static function sumDays(Collection $leaves): float
    {
        return ($leaves->sum('half_days_count') * 0.5) + $leaves->sum('full_days_count');
    }
}
