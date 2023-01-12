<?php

namespace App\Observers;

use App\Models\Leave;

class LeaveObserver extends AuditObserver
{
    /** @var string Model Name */
    private const MODEL_NAME = 'Leave';

    public function __construct()
    {
        $this->setModelName(self::MODEL_NAME);
    }

    /**
     * Handle the Leave "created" event.
     *
     * @param Leave $leave
     * @return void
     */
    public function created(Leave $leave): void
    {
        $this->audit('created', $leave->toArray());
    }

    /**
     * Handle the Leave "updated" event.
     *
     * @param Leave $leave
     * @return void
     */
    public function updated(Leave $leave): void
    {
        $this->audit('updated', $leave->toArray());
    }

    /**
     * Handle the Leave "deleted" event.
     *
     * @param Leave $leave
     * @return void
     */
    public function deleted(Leave $leave): void
    {
        $this->audit('deleted', $leave->toArray());
    }

    /**
     * Handle the Leave "restored" event.
     *
     * @param Leave $leave
     * @return void
     */
    public function restored(Leave $leave): void
    {
        $this->audit('restored', $leave->toArray());
    }

    /**
     * Handle the Leave "force deleted" event.
     *
     * @param Leave $leave
     * @return void
     */
    public function forceDeleted(Leave $leave): void
    {
        $this->audit('forceDeleted', $leave->toArray());
    }
}
