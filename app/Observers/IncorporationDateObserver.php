<?php

namespace App\Observers;

use App\Models\IncorporationDate;
use App\Models\User;
use App\Models\UserHoliday;
use App\Traits\HolidaysTrait;
use App\Traits\SeniorityDaysTrait;

/**
 * IncorporationDateObserver Class
 * @package App\Observers
 */
class IncorporationDateObserver extends AuditObserver
{
    use HolidaysTrait;
    use SeniorityDaysTrait;

    /** @var string Model Name */
    private const MODEL_NAME = 'IncorporationDate';

    public function __construct()
    {
        $this->setModelName(self::MODEL_NAME);
    }

    /**
     * @param IncorporationDate $incorporationDate
     * @return void
     */
    public function created(IncorporationDate $incorporationDate): void
    {
        $user = $incorporationDate->user;
        $incorporationDates = $user?->incorporationDates;

        if ($incorporationDates->count() === 1) {
            $oldestIncorporationDate = $incorporationDate;
        } else {
            $oldestIncorporationDate = $user->incorporationDates()->isNotIntern()->oldest()->first();
        }

        $this->calculateHolidaysForCurrentYear($user, $oldestIncorporationDate);
        $this->calculateHolidaysForNextYear($user, $oldestIncorporationDate);

        $this->audit('created', $incorporationDate->toArray());
    }

    /**
     * Handle the IncorporationDate "updated" event.
     *
     * @param IncorporationDate $incorporationDate
     * @return void
     */
    public function updated(IncorporationDate $incorporationDate): void
    {
        $this->audit('updated', $incorporationDate->toArray());
    }

    /**
     * Handle the IncorporationDate "deleted" event.
     *
     * @param IncorporationDate $incorporationDate
     * @return void
     */
    public function deleted(IncorporationDate $incorporationDate): void
    {
        $this->audit('deleted', $incorporationDate->toArray());
    }

    /**
     * Handle the IncorporationDate "restored" event.
     *
     * @param IncorporationDate $incorporationDate
     * @return void
     */
    public function restored(IncorporationDate $incorporationDate): void
    {
        $this->audit('restored', $incorporationDate->toArray());
    }

    /**
     * Handle the IncorporationDate "force deleted" event.
     *
     * @param IncorporationDate $incorporationDate
     * @return void
     */
    public function forceDeleted(IncorporationDate $incorporationDate): void
    {
        $this->audit('forceDeleted', $incorporationDate->toArray());
    }

    /**
     * Calculate Holidays For Current Year.
     * @param User $user
     * @param IncorporationDate $incorporationDate
     * @return void
     */
    private function calculateHolidaysForCurrentYear(User $user, IncorporationDate $incorporationDate): void
    {
        if ($incorporationDate->isInter()) {
            // Becario
            $holidays = 0;
        } else {
            $holidays = $this->calculateHolidays($incorporationDate);
        }

        $seniorityDays = $this->calculateSeniorityDays($incorporationDate);

        $year = $incorporationDate->begin_date->format('Y');

        // First, check if the user has for the next year
        $userHoliday = UserHoliday::where('user_id', $user->id)
            ->where('year', $year)
            ->first();

        if (is_null($userHoliday)) {
            UserHoliday::create([
                'user_id' => $user->id,
                'year' => $year,
                'holidays' => $holidays,
                'seniority_days' => $seniorityDays,
                'extra' => 0,
            ]);
        } else {
            $userHoliday->holidays = $holidays;
            $userHoliday->seniority_days = $seniorityDays;
            $userHoliday->save();
        }
    }

    /**
     * Calculate Holidays For Next Year.
     * @param User $user
     * @param IncorporationDate $incorporationDate
     * @return void
     */
    private function calculateHolidaysForNextYear(User $user, IncorporationDate $incorporationDate): void
    {
        $holidays = $this->calculateHolidaysNextYear($incorporationDate);
        $seniorityDays = $this->calculateSeniorityDaysNextYear($incorporationDate);

        $year = $incorporationDate->begin_date->addYear()->format('Y');

        // First, check if the user has for the next year
        $userHoliday = UserHoliday::where('user_id', $user->id)
            ->where('year', $year)
            ->first();

        if (is_null($userHoliday)) {
            UserHoliday::create([
                'user_id' => $user->id,
                'year' => $year,
                'holidays' => $holidays,
                'seniority_days' => $seniorityDays,
                'extra' => 0,
            ]);
        } else {
            $userHoliday->holidays = $holidays;
            $userHoliday->save();
        }
    }
}
