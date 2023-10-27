<?php

declare(strict_types=1);

namespace System\Domain\Repositories;

use CodePix\System\Application\Repository\TransactionRepositoryInterface;
use CodePix\System\Domain\DomainTransaction;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function find(string $id): ?DomainTransaction
    {
        dd("TODO: Implement find() method.", $id);
    }

    public function create(DomainTransaction $entity): ?DomainTransaction
    {
        dd("TODO: Implement create() method.", $entity->toArray());
    }

    public function save(DomainTransaction $entity): ?DomainTransaction
    {
        dd("TODO: Implement save() method.", $entity->toArray());
    }

}
