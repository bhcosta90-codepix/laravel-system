<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\Contracts\AMQPInterface;
use App\Services\Contracts\RabbitMQInterface;
use Closure;

class RabbitMQService implements AMQPInterface, RabbitMQInterface
{
    public function publish($name, array $value = []): void
    {
        dump('TODO: Implement publish() method.');
    }

    public function consume(string $queue, array|string $topic, Closure $closure, array $custom = []): void
    {
        dump('TODO: Implement consume() method.');
    }

}
