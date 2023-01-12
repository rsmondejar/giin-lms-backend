<?php

namespace App\Observers;

use App\Models\Business;

class BusinessObserver extends AuditObserver
{
    /** @var string Model Name */
    private const MODEL_NAME = 'Business';

    public function __construct()
    {
        $this->setModelName(self::MODEL_NAME);
    }

    /**
     * Handle the Business "created" event.
     *
     * @param Business $business
     * @return void
     */
    public function created(Business $business): void
    {
        $this->audit('created', $business->toArray());
    }

    /**
     * Handle the Business "updated" event.
     *
     * @param Business $business
     * @return void
     */
    public function updated(Business $business): void
    {
        $this->audit('updated', $business->toArray());
    }

    /**
     * Handle the Business "deleted" event.
     *
     * @param Business $business
     * @return void
     */
    public function deleted(Business $business): void
    {
        $this->audit('deleted', $business->toArray());
    }

    /**
     * Handle the Business "restored" event.
     *
     * @param Business $business
     * @return void
     */
    public function restored(Business $business): void
    {
        $this->audit('restored', $business->toArray());
    }

    /**
     * Handle the Business "force deleted" event.
     *
     * @param Business $business
     * @return void
     */
    public function forceDeleted(Business $business): void
    {
        $this->audit('forceDeleted', $business->toArray());
    }
}
