<?php

namespace App\Http\Controllers;

use App\Models\PublicHoliday;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\PublicHolidayResource;

/**
 * Get Reasons Controller
 * @package App\Http\Controllers
 */
class GetPublicHolidaysController
{
    /**
     * Get Reasons.
     * @return AnonymousResourceCollection
     */
    public static function index(): AnonymousResourceCollection
    {
        $publicHolidays = PublicHoliday::ofYear(now()->year)->orderBy('date')->get();
        return PublicHolidayResource::collection($publicHolidays);
    }
}
