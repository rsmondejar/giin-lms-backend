<?php

namespace App\Http\Controllers;

use App\Http\Controllers\GetRequestHolidaysMetricsController as Metrics;
use Exception;
use JetBrains\PhpStorm\ArrayShape;
use App\Models\User;
use App\Exceptions\HolidaySummaryException;
use App\Exceptions\UserNotFoundException;

/**
 * HolidaySummaryController
 * @package App\Http\Controllers
 */
class HolidaySummaryController
{
    /**
     * Get Holidays Summary
     * @return array
     * @throws Exception
     */
    #[ArrayShape([
        'lastYear' => "mixed",
        'remaining' => "array",
        'sickdays' => "int",
        'seniority_days' => "array"
    ])] public static function index(): array
    {
        try {
            $userId = auth()->id();
            $user = User::find($userId);

            if (is_null($userId)) {
                throw new UserNotFoundException("User auth error.");
            }

            return self::getMetrics($user);
        } catch (Exception $error) {
            throw new HolidaySummaryException($error);
        }
    }

    /**
     * Get User Metrics.
     * @param User $user
     * @return array
     */
    public static function getMetrics(User $user): array
    {
        return [
            'sickness_days' => Metrics::getSicknessDaysByUser($user),
            'unofficial_leaves_days' => Metrics::getUnofficialLeavesDaysByUser($user),
            'leaves_of_absence_days' => Metrics::getLeavesOfAbsenceDaysByUser($user),
            'vacations_days' => Metrics::getCurrentVacationsDaysByUser($user),
            'vacations_remaining_days' => Metrics::getCurrentVacationsRemainingDaysByUser($user),
            'vacations_per_year_days' => Metrics::getVacationsPerYearDaysByUser($user),
            'seniority_days' => Metrics::getCurrentSeniorityDaysByUser($user),
            'seniority_remaining_days' => Metrics::getCurrentSeniorityRemainingDaysByUser($user),
            'seniority_per_year_days' => Metrics::getSeniorityPerYearDaysByUser($user),
            'last_year_vacations_days' => Metrics::getLastYearVacationsDaysByUser($user),
            'last_year_vacations_remaining_days' => Metrics::getLastYearVacationsRemainingDaysByUser($user),
            'last_year_vacations_per_year_days' => Metrics::getLastYearVacationsPerYearDaysByUser($user),
        ];
    }
}
