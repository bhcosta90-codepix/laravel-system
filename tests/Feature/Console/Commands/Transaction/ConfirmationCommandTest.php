<?php

declare(strict_types=1);

use App\Console\Commands\Transaction\ConfirmationCommand;
use App\Models\PixKey;
use App\Models\Transaction;
use CodePix\System\Domain\Enum\EnumTransactionStatus;
use Tests\Stubs\RabbitMQServiceStub;

use function Pest\Laravel\assertDatabaseHas;

describe("ConfirmationCommand Unit Test", function () {
    test("creating a transaction with error", function () {
        $transaction = Transaction::factory()->create(['status' => EnumTransactionStatus::PENDING]);

        $command = new ConfirmationCommand();
        $command->handle(
            new RabbitMQServiceStub([
                "id" => $transaction->id,
            ])
        );

        $transaction->refresh();
        assertDatabaseHas(Transaction::class, [
            'status' => 'confirmed'
        ]);
    });
});
