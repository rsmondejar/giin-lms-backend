<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use JetBrains\PhpStorm\ArrayShape;
use App\Models\User;
use App\Models\Leave;

/**
 * Get Request Holidays Controller
 * @package App\Http\Controllers
 */
class GetRequestHolidaysController
{
    /** @var array|string[] Selected Fields */
    protected static array $selectedFields = ['id', 'comment', 'requested_to_user_id', 'state_id', 'type_id'];

    /**
     * Get Requested Holidays By the User.
     * @param User $user
     * @return array
     */
    #[ArrayShape([
        'pending' => "array", // NOSONAR
        'approved' => "array", // NOSONAR
        'rejected' => "array", // NOSONAR
        'cancelled' => "array" // NOSONAR
    ])]
    public static function getRequestedHolidaysByUser(User $user): array
    {
        return [
            'pending' => self::getPendingHolidaysCurrentYear($user),
            'approved' => self::getApprovedHolidaysCurrentYear($user),
            'rejected' => self::getRejectedHolidaysCurrentYear($user),
            'cancelled' => self::getCancelledHolidaysCurrentYear($user),
        ];
    }

    /**
     * Get Pending Holidays Current Year
     * @param User $user
     * @return Collection
     */
    public static function getPendingHolidaysCurrentYear(User $user): Collection
    {
        return Leave::byUser($user->id)
            ->ofFuture()
            ->statusPending()
            ->with(self::relationships())
            ->select(self::getSelectedFields())
            ->get();
    }

    /**
     * Get Approved Holidays Current Year
     * @param User $user
     * @return Collection
     */
    public static function getApprovedHolidaysCurrentYear(User $user): Collection
    {
        return Leave::byUser($user->id)
            ->ofFuture()
            ->statusApproved()
            ->with(self::relationships())
            ->select(self::getSelectedFields())
            ->get();
    }

    /**
     * Get Rejected Holidays Current Year
     * @param User $user
     * @return Collection
     */
    public static function getRejectedHolidaysCurrentYear(User $user): Collection
    {
        return Leave::byUser($user->id)
            ->ofFuture()
            ->statusRejected()
            ->with(self::relationships())
            ->select(self::getSelectedFields())
            ->get();
    }

    /**
     * Get Cancelled Holidays Current Year
     * @param User $user
     * @return Collection
     */
    public static function getCancelledHolidaysCurrentYear(User $user): Collection
    {
        return Leave::byUser($user->id)
            ->ofFuture()
            ->statusCancelled()
            ->with(self::relationships())
            ->select(self::getSelectedFields())
            ->get();
    }

    /**
     * Internal relationships
     * @return Closure[]
     */
    #[ArrayShape([
        'dates' => "Closure", // NOSONAR
        'manager' => "Closure", // NOSONAR
        'state' => "Closure", // NOSONAR
        'type' => "Closure", // NOSONAR
    ])]
    protected static function relationships(): array
    {
        return [
            'dates' => fn ($query) => $query->select(['id', 'leave_id', 'date', 'is_half_day', 'is_cancelled']),
            'manager' => fn ($query) => $query->select(
                ['id', 'name', 'email',]
            ),
            'state' => fn ($query) => $query->select(['id', 'name']),
            'type' => fn ($query) => $query->select(['id', 'name']),
        ];
    }

    /**
     * @return array
     */
    protected static function getSelectedFields(): array
    {
        return self::$selectedFields;
    }

    /**
     * @param array $selectedFields
     */
    protected static function setSelectedFields(array $selectedFields): void
    {
        self::$selectedFields = $selectedFields;
    }
}
