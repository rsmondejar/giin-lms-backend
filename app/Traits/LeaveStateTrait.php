<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Interfaces\ILeaveState;

/**
 * Trait LeaveStateTrait
 * @package App\Traits
 */
trait LeaveStateTrait
{
    /**
     * Scope Status Pending
     * @param Builder $query
     * @return Builder
     */
    public function scopeStatusPending(Builder $query): Builder
    {
        return $query->where('state_id', ILeaveState::PENDING);
    }

    /**
     * Scope Status Approved
     * @param Builder $query
     * @return Builder
     */
    public function scopeStatusApproved(Builder $query): Builder
    {
        return $query->where('state_id', ILeaveState::APPROVED);
    }

    /**
     * Scope Status Rejected
     * @param Builder $query
     * @return Builder
     */
    public function scopeStatusRejected(Builder $query): Builder
    {
        return $query->where('state_id', ILeaveState::REJECTED);
    }

    /**
     * Scope Status Cancelled
     * @param Builder $query
     * @return Builder
     */
    public function scopeStatusCancelled(Builder $query): Builder
    {
        return $query->where('state_id', ILeaveState::CANCELLED);
    }

    /**
     * Scope Is Allowed
     * @param Builder $query
     * @return Builder
     */
    public function scopeIsAllowed(Builder $query): Builder
    {
        return $query->where('state_id', ILeaveState::PENDING)
            ->orWhere('state_id', ILeaveState::APPROVED);
    }
}
