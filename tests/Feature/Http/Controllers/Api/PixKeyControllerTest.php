<?php

declare(strict_types=1);

use App\Models\PixKey;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\postJson;

beforeEach(fn() => $this->defaults = [
    'bank' => str()->uuid(),
]);

describe("PixKeyController Feature Test", function () {
    test("creating a multiple pix", function ($data) {
        $response = postJson('/api/pix', $this->defaults + $data)->assertJsonStructure([
            'data' => [
                'bank',
                'kind',
                'key',
                'id',
                'created_at',
                'updated_at',
            ],
        ]);

        assertDatabaseCount('pix_keys', 1);
        assertDatabaseHas('pix_keys', $response->json('data'));
    })->with([
        [['key' => 'test@test.com', 'kind' => 'email']],
        [['key' => '(19) 98870-9090', 'kind' => 'phone']],
        [['kind' => 'id']],
        [['key' => '84.209.990/0001-62', 'kind' => 'document']],
    ]);

    test("creating a new pix but it already exists in our database", function(){
        PixKey::factory()->create($pix = [
            'kind' => 'email',
            'key' => 'test@test.com'
        ]);

        postJson('/api/pix', $this->defaults + $pix)->assertStatus(422)->assertJsonStructure([
            'message',
            'errors',
        ])->dump();
    });
});
