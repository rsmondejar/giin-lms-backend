<?php

namespace Tests\Helpers;

use App\Helpers\BackendVersion;
use Tests\TestCase;

class BackendVersionTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test Get Package Version OK
     */
    public function test_get_package_version_ko(): void
    {
        $version = BackendVersion::getPackageVersion();
        $this->assertEquals(env('APP_VERSION'), $version);
    }

    /**
     * @test Get Package Version File Nout Found
     */
    public function test_get_package_version_file_not_found(): void
    {
        BackendVersion::setComposerFileName('file-not-found.json');
        $version = BackendVersion::getPackageVersion();
        $this->assertNull($version);
    }
}
