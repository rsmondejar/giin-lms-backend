<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\GetPublicHolidaysController;
use Throwable;

/**
 * Get Public Holidays Api Controller
 * €package App\Http\Controllers\API
 */
class GetPublicHolidaysAPIController extends BaseAPIController
{

    public function __invoke(): JsonResponse
    {
        $output = self::baseResponse();

        try {
            $output['message'] = "Public Holidays";
            $output['data'] = GetPublicHolidaysController::index();
        } catch (Throwable $error) {
            $output['error'] = true;
            $output['status'] = 400;
            $output['message'] = $error->getMessage();
            $output['errors'][] = $error->getMessage();
        }

        return response()->json($output)->setStatusCode($output['status']);
    }
}
