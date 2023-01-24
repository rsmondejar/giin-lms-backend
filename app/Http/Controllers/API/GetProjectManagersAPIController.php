<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\GetProjectManagersController;
use Throwable;

class GetProjectManagersAPIController extends BaseAPIController
{
    /**
     * Get Project Managers
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $output = self::baseResponse();

        try {
            $output['message'] = "Project Managers";
            $output['data'] = (new GetProjectManagersController())->__invoke();
        } catch (Throwable $error) {
            $output['error'] = true;
            $output['status'] = 400;
            $output['error_code'] = $error->getCode();
            $output['message'] = $error->getMessage();
            $output['errors'][] = $error->getMessage();
        }

        return response()->json($output)->setStatusCode($output['status']);
    }
}
