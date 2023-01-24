<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Traits\BaseResponseHelper;

/**
 * Api Exception
 * @package App\Exceptions
 */
abstract class ApiException extends Exception
{
    use BaseResponseHelper;

    /**
     * Register the exception handling callbacks for the application.
     * @return JsonResponse
     */
    abstract public function render(): JsonResponse;
}
