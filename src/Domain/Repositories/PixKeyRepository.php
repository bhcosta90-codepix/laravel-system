<?php

declare(strict_types=1);

namespace System\Domain\Repositories;

use CodePix\System\Application\Repository\PixKeyRepositoryInterface;
use CodePix\System\Domain\DomainPixKey;
use CodePix\System\Domain\Enum\EnumPixType;

class PixKeyRepository implements PixKeyRepositoryInterface
{
    public function find(EnumPixType $kind, string $key): ?DomainPixKey
    {
        dd('TODO: Implement find() method.', $kind->value, $key);
    }

    public function create(DomainPixKey $entity): ?DomainPixKey
    {
        dd('TODO: Implement create() method.', $entity->toArray());
    }
}
