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
    private static string $composerFileName = "composer.json";

    /**
     * Get Package Version
     * @return string|null
     */
    public static function getPackageVersion(): ?string
    {
        $packageVersion = null;
        try {
            $composer = json_decode(File::get(base_path() . '/' .self::getComposerFileName()));

            $packageVersion = $composer->version;
        } catch (\Exception $error) {
            Log::warning('Error getting composer package version');
            Log::warning($error->getMessage());
        }

        return $packageVersion;
    }

    /**
     * Set Composer File Name.
     * @param string $fileName Composer File Name.
     * @return void
     */
    public static function setComposerFileName(string $fileName = "composer.json"): void
    {
        self::$composerFileName = $fileName;
    }

    /**
     * Get Composer File Name.
     * @return string Composer File Name.
     */
    public static function getComposerFileName(): string
    {
        return self::$composerFileName;
    }
}
