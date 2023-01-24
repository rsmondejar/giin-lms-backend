<?php

namespace App\Http\Controllers;

use App\Http\Resources\HolidaysResource;
use App\Interfaces\ILeaveState;
use App\Models\Leave;
use App\Models\PublicHoliday;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetHolidaysController
{
    /**
     * Get Holidays.
     * @return AnonymousResourceCollection
     */
    public static function index(): AnonymousResourceCollection
    {
        $userId = auth()->id();

        $holidays = collect([]);
        $publicHolidays = PublicHoliday::ofFuture()->get();

        $publicHolidays->each(fn ($holiday) => $holidays->push($holiday));

        // Get holidays last Year, current and next year (future)
        $leaveDates = Leave::ofLastYearCurrentAndFuture()
            ->whereIn('state_id', [ILeaveState::PENDING, ILeaveState::APPROVED])
            ->where('user_id', $userId)
            ->get()
            ->pluck('dates');

        $leaveDates->each->each(fn ($holiday) => $holidays->push($holiday));

        return HolidaysResource::collection($holidays);
    }
}
