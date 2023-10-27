<?php

declare(strict_types=1);

namespace System\Domain\Repositories;

use App\Models\PixKey;
use CodePix\System\Application\Repository\PixKeyRepositoryInterface;
use CodePix\System\Domain\DomainPixKey;
use CodePix\System\Domain\Enum\EnumPixType;

class PixKeyRepository implements PixKeyRepositoryInterface
{
    public function find(EnumPixType $kind, string $key): ?DomainPixKey
    {
        return $this->toEntity(PixKey::where('kind', $kind)->where('key', $key)->first());
    }

    public function create(DomainPixKey $entity): ?DomainPixKey
    {
        $db = PixKey::create(['bank' => config('system.bank')] + $entity->toArray());
        return $this->toEntity($db);
    }

    protected function toEntity(?PixKey $model): ?DomainPixKey
    {
        if ($model) {
            $data = [
                'kind' => EnumPixType::from($model->kind),
            ];
            return DomainPixKey::make($data + $model->toArray());
        }

        return null;
    }
}
