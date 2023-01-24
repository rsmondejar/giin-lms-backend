<?php

namespace App\Traits;

use JetBrains\PhpStorm\ArrayShape;

/**
 * Trait BaseResponseHelper.
 */
trait BaseResponseHelper
{
    /**
     * Base Response
     * @return array Base Response
     */
    #[ArrayShape([
        'status' => "int",
        'message' => "null",
        'error' => "false",
        'errors' => "array",
        'error_code' => "int",
        'data' => "null"
    ])]
    protected static function baseResponse(): array
    {
        return [
            'status' => 200,
            'message' => null,
            'error' => false,
            'errors' => [],
            'error_code' => null,
            'data' => null,
        ];
    }
}
