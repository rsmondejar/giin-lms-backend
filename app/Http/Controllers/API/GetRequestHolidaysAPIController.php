<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\JsonResponse;
use App\Models\User;
use App\Http\Controllers\GetRequestHolidaysController;
use Throwable;

/**
 * Get Request Holidays.
 * Manage Request of type Holidays.
 * @package App\Http\Controllers\API
 */
class GetRequestHolidaysAPIController extends BaseAPIController
{
    /**
     * Get Requested Holiday
     * @throws Throwable
     */
    public function __invoke(): JsonResponse
    {
        $output = self::baseResponse();

        try {
            $user = User::find(auth()->id());

            $output['message'] = "Request Holidays by the user";
            $output['data']['holidays_states'] = GetRequestHolidaysController::getRequestedHolidaysByUser($user);
        } catch (Throwable $error) {
            $output['error'] = true;
            $output['status'] = 400;
            $output['message'] = $error->getMessage();
            $output['errors'][] = $error->getMessage();
        }

        return response()->json($output)->setStatusCode($output['status']);
    }
}
