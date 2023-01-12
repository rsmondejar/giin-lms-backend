<?php

namespace App\Observers;

use App\Models\LeaveDate;

class LeaveDateObserver extends AuditObserver
{
    /** @var string Model Name */
    private const MODEL_NAME = 'LeaveDate';

    public function __construct()
    {
        $this->setModelName(self::MODEL_NAME);
    }

    /**
     * Handle the LeaveDate "created" event.
     *
     * @param LeaveDate $leaveDate
     * @return void
     */
    public function created(LeaveDate $leaveDate): void
    {
        $this->audit('created', $leaveDate->toArray());
    }

    /**
     * Handle the LeaveDate "updated" event.
     *
     * @param LeaveDate $leaveDate
     * @return void
     */
    public function updated(LeaveDate $leaveDate): void
    {
        $this->audit('updated', $leaveDate->toArray());
    }

    /**
     * Handle the LeaveDate "deleted" event.
     *
     * @param LeaveDate $leaveDate
     * @return void
     */
    public function deleted(LeaveDate $leaveDate): void
    {
        $this->audit('deleted', $leaveDate->toArray());
    }

    /**
     * Handle the LeaveDate "restored" event.
     *
     * @param LeaveDate $leaveDate
     * @return void
     */
    public function restored(LeaveDate $leaveDate): void
    {
        $this->audit('restored', $leaveDate->toArray());
    }

    /**
     * Handle the LeaveDate "force deleted" event.
     *
     * @param LeaveDate $leaveDate
     * @return void
     */
    public function forceDeleted(LeaveDate $leaveDate): void
    {
        $this->audit('forceDeleted', $leaveDate->toArray());
    }
}
