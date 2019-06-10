<?php

namespace Tests\Services;

use SierraTecnologia\Cms\Services\BlogService;
use SierraTecnologia\Cms\Services\Normalizer;
use Tests\TestCase;

class BlogServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->service = app(BlogService::class);
    }

    public function testGetTemplatesAsOptions()
    {
        $result = $this->service->getTemplatesAsOptions();

        $this->assertTrue(is_array($result));
        $this->assertEquals('show', $result[0]);
    }
}
