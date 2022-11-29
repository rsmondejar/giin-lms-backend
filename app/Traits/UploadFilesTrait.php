<?php

namespace App\Traits;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

/**
 * Class UploadFilesTrait
 * @package App\Traits
 */
trait UploadFilesTrait
{
    /**
     * Función para guardar los ficheros que se suben por BackOffice
     * @param $files $request->all()
     * @param string $folder
     * @param bool $publicPath
     * @return array $request->all()
     */
    public static function saveFiles(array $files, string $folder = 'files', bool $publicPath = true): array
    {
        foreach ($files as $key => $value) {
            $filename = self::saveFile($key, $folder, $publicPath);

            if (!is_null($filename)) {
                $files[$key] = $filename;
            }
        }
        unset($key);
        unset($value);

        return $files;
    }

    /**
     * Save File
     * @param string $key
     * @param string $folder
     * @param bool $publicPath
     * @return string|null
     */
    public static function saveFile(string $key, string $folder = 'files', bool $publicPath = true): ?string
    {
        if (!Request::hasFile($key)) {
            return null;
        }

        $file = Request::file($key);

        $fileInfo = pathinfo($file->getClientOriginalName());

        $folder = rtrim($folder, '/');
        $folder = ltrim($folder, '/');

        $filename = date('YmdHis-') . Str::slug($fileInfo['filename']) . "." . $fileInfo['extension'];

        if ($publicPath) {
            $destinationPath = public_path() . "/{$folder}/";
        } else {
            $destinationPath = "/{$folder}/";
        }

        $file->move($destinationPath, $filename);
        return $filename;
    }
}
