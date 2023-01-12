<?php

namespace App\Observers;

use App\Models\User;

class UserObserver extends AuditObserver
{
    /** @var string Model Name */
    private const MODEL_NAME = 'User';

    public function __construct()
    {
        $this->setModelName(self::MODEL_NAME);
    }

    /**
     * Handle the User "created" event.
     *
     * @param User $user
     * @return void
     */
    public function created(User $user): void
    {
        $this->audit('created', $user->toArray());
    }

    /**
     * Handle the User "updated" event.
     *
     * @param User $user
     * @return void
     */
    public function updated(User $user): void
    {
        $this->audit('updated', $user->toArray());
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param User $user
     * @return void
     */
    public function deleted(User $user): void
    {
        $this->audit('deleted', $user->toArray());
    }

    /**
     * Handle the User "restored" event.
     *
     * @param User $user
     * @return void
     */
    public function restored(User $user): void
    {
        $this->audit('restored', $user->toArray());
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param User $user
     * @return void
     */
    public function forceDeleted(User $user): void
    {
        $this->audit('forceDeleted', $user->toArray());
    }
}
