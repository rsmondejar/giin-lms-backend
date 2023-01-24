<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\GetReasonsController;
use Throwable;

/**
 * Get Unplanned Reasons Api Controller
 * €package App\Http\Controllers\API
 */
class GetUnplannedReasonsAPIController extends BaseAPIController
{

    public function __invoke(): JsonResponse
    {
        $output = self::baseResponse();

        try {
            $output['message'] = "Request Unplanned Reasons";
            $output['data'] = GetReasonsController::getUnplannedReasons();
        } catch (Throwable $error) {
            $output['error'] = true;
            $output['status'] = 400;
            $output['message'] = $error->getMessage();
            $output['errors'][] = $error->getMessage();
        }

        return response()->json($output)->setStatusCode($output['status']);
    }
}
