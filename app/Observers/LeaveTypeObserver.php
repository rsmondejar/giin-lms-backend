<?php

namespace App\Observers;

use App\Models\LeaveType;

class LeaveTypeObserver extends AuditObserver
{
    /** @var string Model Name */
    private const MODEL_NAME = 'LeaveType';

    public function __construct()
    {
        $this->setModelName(self::MODEL_NAME);
    }

    /**
     * Handle the LeaveType "created" event.
     *
     * @param LeaveType $leaveType
     * @return void
     */
    public function created(LeaveType $leaveType): void
    {
        $this->audit('created', $leaveType->toArray());
    }

    /**
     * Handle the LeaveType "updated" event.
     *
     * @param LeaveType $leaveType
     * @return void
     */
    public function updated(LeaveType $leaveType): void
    {
        $this->audit('updated', $leaveType->toArray());
    }

    /**
     * Handle the LeaveType "deleted" event.
     *
     * @param LeaveType $leaveType
     * @return void
     */
    public function deleted(LeaveType $leaveType): void
    {
        $this->audit('deleted', $leaveType->toArray());
    }

    /**
     * Handle the LeaveType "restored" event.
     *
     * @param LeaveType $leaveType
     * @return void
     */
    public function restored(LeaveType $leaveType): void
    {
        $this->audit('restored', $leaveType->toArray());
    }

    /**
     * Handle the LeaveType "force deleted" event.
     *
     * @param LeaveType $leaveType
     * @return void
     */
    public function forceDeleted(LeaveType $leaveType): void
    {
        $this->audit('forceDeleted', $leaveType->toArray());
    }
}
