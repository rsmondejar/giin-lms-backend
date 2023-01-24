<?php

namespace App\Http\Controllers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Models\LeaveType;
use App\Http\Resources\LeaveTypeResource;

/**
 * Get Reasons Controller
 * @package App\Http\Controllers
 */
class GetReasonsController
{
    /**
     * Get Reasons.
     * @return AnonymousResourceCollection
     */
    public static function getReasons(): AnonymousResourceCollection
    {
        $leaveTypes = LeaveType::orderBy('name')->get();
        return LeaveTypeResource::collection($leaveTypes);
    }

    /**
     * Get Unplanned Reasons.
     * @return AnonymousResourceCollection
     */
    public static function getUnplannedReasons(): AnonymousResourceCollection
    {
        $leaveTypes = LeaveType::isUnplanned()->orderBy('name')->get();
        return LeaveTypeResource::collection($leaveTypes);
    }
}
