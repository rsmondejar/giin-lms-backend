<?php

namespace App\Observers;

use App\Models\LeaveState;

class LeaveStateObserver extends AuditObserver
{
    /** @var string Model Name */
    private const MODEL_NAME = 'LeaveState';

    public function __construct()
    {
        $this->setModelName(self::MODEL_NAME);
    }

    /**
     * Handle the LeaveState "created" event.
     *
     * @param LeaveState $leaveState
     * @return void
     */
    public function created(LeaveState $leaveState): void
    {
        $this->audit('created', $leaveState->toArray());
    }

    /**
     * Handle the LeaveState "updated" event.
     *
     * @param LeaveState $leaveState
     * @return void
     */
    public function updated(LeaveState $leaveState): void
    {
        $this->audit('updated', $leaveState->toArray());
    }

    /**
     * Handle the LeaveState "deleted" event.
     *
     * @param LeaveState $leaveState
     * @return void
     */
    public function deleted(LeaveState $leaveState): void
    {
        $this->audit('deleted', $leaveState->toArray());
    }

    /**
     * Handle the LeaveState "restored" event.
     *
     * @param LeaveState $leaveState
     * @return void
     */
    public function restored(LeaveState $leaveState): void
    {
        $this->audit('restored', $leaveState->toArray());
    }

    /**
     * Handle the LeaveState "force deleted" event.
     *
     * @param LeaveState $leaveState
     * @return void
     */
    public function forceDeleted(LeaveState $leaveState): void
    {
        $this->audit('forceDeleted', $leaveState->toArray());
    }
}
