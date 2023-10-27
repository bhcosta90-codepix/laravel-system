<?php

declare(strict_types=1);

use App\Models\PixKey;
use BRCas\CA\Exceptions\DomainNotFoundException;
use CodePix\System\Application\UseCases\PixKey\FindUseCase;

use CodePix\System\Domain\DomainPixKey;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertInstanceOf;

beforeEach(function () {
    $this->pix = PixKey::factory()->create(['kind' => 'email', 'key' => 'test@test.com']);

    $this->useCase = app(FindUseCase::class);
});

describe("FindUseCase Feature Test", function () {
    test("searching a PixKey", function () {
        $response = $this->useCase->exec('email', 'test@test.com');
        assertInstanceOf(DomainPixKey::class, $response);
        assertEquals('email', $response->kind->value);
        assertEquals('test@test.com', $response->key);
    });

    test("exception -> searching a PixKey", function () {
        expect(fn() => $this->useCase->exec('email', 'test1@test.com'))->toThrow(DomainNotFoundException::class);
    });
});
