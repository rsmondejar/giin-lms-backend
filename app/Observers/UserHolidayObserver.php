<?php

namespace App\Observers;

use App\Models\UserHoliday;

class UserHolidayObserver extends AuditObserver
{
    /** @var string Model Name */
    private const MODEL_NAME = 'UserHoliday';

    public function __construct()
    {
        $this->setModelName(self::MODEL_NAME);
    }

    /**
     * Handle the UserHoliday "created" event.
     *
     * @param UserHoliday $userHoliday
     * @return void
     */
    public function created(UserHoliday $userHoliday): void
    {
        $this->audit('created', $userHoliday->toArray());
    }

    /**
     * Handle the UserHoliday "updated" event.
     *
     * @param UserHoliday $userHoliday
     * @return void
     */
    public function updated(UserHoliday $userHoliday): void
    {
        $this->audit('updated', $userHoliday->toArray());
    }

    /**
     * Handle the UserHoliday "deleted" event.
     *
     * @param UserHoliday $userHoliday
     * @return void
     */
    public function deleted(UserHoliday $userHoliday): void
    {
        $this->audit('deleted', $userHoliday->toArray());
    }

    /**
     * Handle the UserHoliday "restored" event.
     *
     * @param UserHoliday $userHoliday
     * @return void
     */
    public function restored(UserHoliday $userHoliday): void
    {
        $this->audit('restored', $userHoliday->toArray());
    }

    /**
     * Handle the UserHoliday "force deleted" event.
     *
     * @param UserHoliday $userHoliday
     * @return void
     */
    public function forceDeleted(UserHoliday $userHoliday): void
    {
        $this->audit('forceDeleted', $userHoliday->toArray());
    }
}
