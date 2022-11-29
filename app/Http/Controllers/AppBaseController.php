<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use InfyOm\Generator\Utils\ResponseUtil;
use OpenApi\Annotations as OA;

/**
 * @OA\Server(url="/api")
 * @OA\Info(
 *   title="InfyOm Laravel Generator APIs",
 *   version="1.0.0"
 * )
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        return response()->json(ResponseUtil::makeResponse($message, $result));
    }

    public function sendError($error, $code = 404)
    {
        return response()->json(ResponseUtil::makeError($error), $code);
    }

    public function sendSuccess($message)
    {
        return response()->json([
            'success' => true,
            'message' => $message
        ], 200);
    }

    /**
     * Get Package Version
     * @return string|null
     */
    public static function getPackageVersion(): ?string
    {
        $packageVersion = null;
        try {
            $composer = json_decode(File::get(base_path() . '/composer.json'));

            $packageVersion = $composer->version;
        } catch (Exception $error) {
            Log::warning('Error getting composer package version');
            Log::warning($error->getMessage());
        }

        return $packageVersion;
    }
}
