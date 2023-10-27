<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\Contracts\AMQPInterface;
use App\Services\Contracts\RabbitMQInterface;
use Bschmitt\Amqp\Facades\Amqp;
use Closure;
use Illuminate\Support\Facades\Log;
use Throwable;

class RabbitMQService implements AMQPInterface, RabbitMQInterface
{
    public function __construct(){
        //
    }

    public function publish($name, array $value = []): void
    {
        Amqp::publish($name, json_encode($value));
    }

    public function consume(string $queue, array|string $topic, Closure $closure, array $custom = []): void
    {
        if (is_string($topic)) {
            $topic = [$topic];
        }

        $topic = [
            'routing' => $topic,
        ];

        Amqp::consume($queue, function ($message, $resolver) use ($queue, $closure) {
            try {
                $closure($message->body);
                $resolver->acknowledge($message);
            } catch (Throwable $e) {
                Log::error("Error consumer {$queue}: " . $e->getMessage() . json_encode($e->getTrace()));
            }
        }, $custom + $topic);
    }

}
