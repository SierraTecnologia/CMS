<?php

namespace Tests\Services;

use Tests\TestCase;
use SierraTecnologia\Cms\Services\Normalizer;

class NormalizerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new Normalizer('<p>sample</p>');
    }

    public function testToString()
    {
        $result = $this->service->__toString();

        $this->assertContains('sample', $result);
    }

    public function testPlain()
    {
        $result = $this->service->plain();

        $this->assertEquals('sample', $result);
    }
}
