<?php declare(strict_types=1);

use NorteDev\Produtor;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class ProdutorTest extends TestCase
{
    public function testCanBeCreatedFromValidIpAddress(): void
    {
        $uuid = Uuid::uuid4();
        $producer = new Produtor(true, false);
        $this->assertIsString((string)$producer->producer(uniqid((string)time(), true), TOPICS[0], [
            'clientID' => $uuid->toString(),
            'timestamp' => time(),
            'ip' => "127.0.0.1",
        ]));
    }
}