<?php

namespace App\Observers;

use App\Models\Department;

class DepartmentObserver extends AuditObserver
{
    /** @var string Model Name */
    private const MODEL_NAME = 'Department';

    public function __construct()
    {
        $this->setModelName(self::MODEL_NAME);
    }

    /**
     * Handle the Department "created" event.
     *
     * @param Department $department
     * @return void
     */
    public function created(Department $department): void
    {
        $this->audit('created', $department->toArray());
    }

    /**
     * Handle the Department "updated" event.
     *
     * @param Department $department
     * @return void
     */
    public function updated(Department $department): void
    {
        $this->audit('updated', $department->toArray());
    }

    /**
     * Handle the Department "deleted" event.
     *
     * @param Department $department
     * @return void
     */
    public function deleted(Department $department): void
    {
        $this->audit('deleted', $department->toArray());
    }

    /**
     * Handle the Department "restored" event.
     *
     * @param Department $department
     * @return void
     */
    public function restored(Department $department): void
    {
        $this->audit('restored', $department->toArray());
    }

    /**
     * Handle the Department "force deleted" event.
     *
     * @param Department $department
     * @return void
     */
    public function forceDeleted(Department $department): void
    {
        $this->audit('forceDeleted', $department->toArray());
    }
}
