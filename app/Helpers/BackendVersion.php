<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

/**
 * Class BackendVersion
 * @package App\Helpers
 */
class BackendVersion
{
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
        } catch (\Exception $error) {
            Log::warning('Error getting composer package version');
            Log::warning($error->getMessage());
        }

        return $packageVersion;
    }
}
