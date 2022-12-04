<?php

namespace Tests\Traits;

use App\Traits\UploadFilesTrait;
use Tests\TestCase;

class UploadFilesTraitTest extends TestCase
{
    /**
     * @test Get Package Version OK
     */
    public function test_save_file_ok()
    {
        // @TODO:
        $file = "test.jpg";
        $response = UploadFilesTrait::saveFile($file);
    }
}
