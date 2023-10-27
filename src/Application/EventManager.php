<?php

declare(strict_types=1);

namespace System\Application;

use BRCas\CA\Contracts\Event\EventManagerInterface;
use Costa\Entity\Contracts\EventInterface;

class EventManager implements EventManagerInterface
{
    public function dispatch(array $events): void
    {
        foreach ($events as $event) {
            event($event);
        }
    }

}