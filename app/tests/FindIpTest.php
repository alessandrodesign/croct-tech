<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class FindIpTest extends TestCase
{

    public function testCanBeCreatedFromValidIpAddress(): void
    {
        $response = (new \NorteDev\FindIp("186.249.209.208"))->response();
        $this->assertArrayHasKey("latitude", $response);
    }
}