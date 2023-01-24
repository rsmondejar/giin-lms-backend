<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\GetReasonsController;
use Throwable;

/**
 * Get Reasons Api Controller
 * €package App\Http\Controllers\API
 */
class GetReasonsAPIController extends BaseAPIController
{

    public function __invoke(): JsonResponse
    {
        $output = self::baseResponse();

        try {
            $output['message'] = "Request Reasons";
            $output['data'] = GetReasonsController::getReasons();
        } catch (Throwable $error) {
            $output['error'] = true;
            $output['status'] = 400;
            $output['message'] = $error->getMessage();
            $output['errors'][] = $error->getMessage();
        }

        return response()->json($output)->setStatusCode($output['status']);
    }
}
