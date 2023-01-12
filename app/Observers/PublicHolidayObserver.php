<?php

namespace App\Observers;

use App\Models\PublicHoliday;

class PublicHolidayObserver extends AuditObserver
{
    /** @var string Model Name */
    private const MODEL_NAME = 'PublicHoliday';

    public function __construct()
    {
        $this->setModelName(self::MODEL_NAME);
    }

    /**
     * Handle the PublicHoliday "created" event.
     *
     * @param PublicHoliday $publicHoliday
     * @return void
     */
    public function created(PublicHoliday $publicHoliday): void
    {
        $this->audit('created', $publicHoliday->toArray());
    }

    /**
     * Handle the PublicHoliday "updated" event.
     *
     * @param PublicHoliday $publicHoliday
     * @return void
     */
    public function updated(PublicHoliday $publicHoliday): void
    {
        $this->audit('updated', $publicHoliday->toArray());
    }

    /**
     * Handle the PublicHoliday "deleted" event.
     *
     * @param PublicHoliday $publicHoliday
     * @return void
     */
    public function deleted(PublicHoliday $publicHoliday): void
    {
        $this->audit('deleted', $publicHoliday->toArray());
    }

    /**
     * Handle the PublicHoliday "restored" event.
     *
     * @param PublicHoliday $publicHoliday
     * @return void
     */
    public function restored(PublicHoliday $publicHoliday): void
    {
        $this->audit('restored', $publicHoliday->toArray());
    }

    /**
     * Handle the PublicHoliday "force deleted" event.
     *
     * @param PublicHoliday $publicHoliday
     * @return void
     */
    public function forceDeleted(PublicHoliday $publicHoliday): void
    {
        $this->audit('forceDeleted', $publicHoliday->toArray());
    }
}
