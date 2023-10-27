<?php

declare(strict_types=1);

use Costa\Entity\ValueObject\Uuid;

return [
    'bank' => new Uuid(env('BANK_ID', '3e5d15ea-a874-48b5-aae3-77ee1f9bbb34')),
];
