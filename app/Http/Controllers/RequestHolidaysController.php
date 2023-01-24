<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Models\Leave;
use App\Models\LeaveDate;

/**
 * RequestHolidaysController
 * @package App\Http\Controllers
 */
class RequestHolidaysController
{

    /**
     * Get Sum Days
     * @param array $dates
     * @return float
     */
    public static function getSumDays(array $dates): float
    {
        $total = 0.0;
        foreach ($dates as $date) {
            $total += 1;
        }
        return (float)$total;
    }

    /**
     * Get First Day
     * @param array $dates
     * @return Carbon
     */
    public static function getFirstDay(array $dates): Carbon
    {
        $firstDate = null;
        foreach ($dates as $date) {
            $dateFormatted = Carbon::parse($date, "Europe/Madrid");
            if (is_null($firstDate) || $firstDate > $dateFormatted) {
                $firstDate = $dateFormatted;
            }
        }
        return $firstDate;
    }

    /**
     * Get Last Day
     * @param array $dates
     * @return Carbon
     */
    public static function getLastDay(array $dates): Carbon
    {
        $lastDate = null;
        foreach ($dates as $date) {
            $dateFormatted = Carbon::parse($date, "Europe/Madrid");
            if (is_null($lastDate) || $lastDate < $dateFormatted) {
                $lastDate = $dateFormatted;
            }
        }
        return $lastDate;
    }

    /**
     * Get Array From Dates.
     * @param array $dates
     * @return array
     */
    protected static function getArrayFromDates(array $dates): array
    {
        $requestDatesArray = [];
        foreach ($dates as $date) {
            $requestDatesArray[] = $date;
        }
        return $requestDatesArray;
    }

    /**
     * Get Previous Leaves.
     * @param array $requestDatesArray
     * @return mixed
     */
    protected static function getPreviousLeaves(array $requestDatesArray): mixed
    {
        return LeaveDate::byUser(auth()->id())
            ->whereIn('date', $requestDatesArray)
            ->where('is_cancelled', false)
            ->select('date')
            ->get();
    }

    /**
     * Process Leave Dates
     * @param Leave $leave
     * @param Collection $previousLeaves
     * @param array $dates
     * @return array
     */
    protected static function processLeaveDates(Leave $leave, Collection $previousLeaves, array $dates): array
    {
        $daysNotProcessed = [];
        foreach ($dates as $date) {
            /*
             * No debería hacer falta comprobar que no cae en un festivo o fin de semana,
             * ese check se hace ya en el front.
             */
            // Check if day is not previously requested
            if (!$previousLeaves->contains('date', Carbon::parse($date['dateFormatted']))) {
                $leave->dates()->create([
                    'date' => $date['dateFormatted'],
                    'is_half_day' => $date['is_halfday'],
                ]);
            } else {
                $daysNotProcessed[] = [
                    'date' => $date['dateFormatted'],
                    'reason' => 'Date previously requested by the user and it is not cancelled',
                ];
            }
        }

        return $daysNotProcessed;
    }
}
