<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Http\Controllers\HolidaySummaryController;
use Illuminate\Http\JsonResponse;

class HolidaySummaryAPIController extends BaseAPIController
{
    /**
     * Get Holidays Summary
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $output = self::baseResponse();

        try {
            $response = HolidaySummaryController::index();

            $output['message'] = "Holidays Summary";
            $output['data'] = $response;
        } catch (Exception $error) {
            $output['error'] = true;
            $output['status'] = 400;
            $output['message'] = $error->getMessage();
            $output['errors'][] = $error->getMessage();
        }

        return response()->json($output)->setStatusCode($output['status']);
    }
}
