<?php

declare(strict_types=1);

namespace System\Domain\Repositories;

use App\Models\Transaction;
use CodePix\System\Application\Repository\TransactionRepositoryInterface;
use CodePix\System\Domain\DomainTransaction;
use CodePix\System\Domain\Enum\EnumPixType;
use CodePix\System\Domain\Enum\EnumTransactionStatus;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function find(string $id): ?DomainTransaction
    {
        return $this->toEntity(Transaction::find($id));
    }

    public function create(DomainTransaction $entity): ?DomainTransaction
    {
        Transaction::create($entity->toArray());
        return $entity;
    }

    public function save(DomainTransaction $entity): ?DomainTransaction
    {
        dd("TODO: Implement save() method.", $entity->toArray());
    }

    protected function toEntity(?Transaction $model): ?DomainTransaction
    {
        if ($model) {
            $data = [
                'kind' => EnumPixType::from($model->kind),
                'status' => EnumTransactionStatus::from($model->status),
            ];
            return DomainTransaction::make($data + $model->toArray());
        }

        return null;
    }

}
