<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Http\Controllers\GetHolidaysController;
use Illuminate\Http\JsonResponse;

/**
 * Get Holidays.
 * @package App\Http\Controllers\API
 */
class GetHolidaysAPIController extends BaseAPIController
{
    /**
     * Get Holidays Summary
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $output = self::baseResponse();

        try {
            $response = GetHolidaysController::index();

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
