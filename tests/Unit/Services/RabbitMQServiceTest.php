<?php

declare(strict_types=1);

use App\Services\RabbitMQService;

use function PHPUnit\Framework\assertTrue;

describe("RabbitMQServiceTest Unit Test", function(){
    test("testing a publish", function(){
        $service = new RabbitMQService();
        $service->publish("testing", []);
        assertTrue(true);
    });

    test("testing a consumer", function(){
        $service = new RabbitMQService();
        $service->consume("testing", "testing", fn() => true);
        assertTrue(true);
    });
});
