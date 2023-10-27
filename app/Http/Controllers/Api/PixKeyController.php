<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PixKeyRequest;
use App\Http\Resources\PixKeyResource;
use CodePix\System\Application\UseCases\PixKey\CreateUseCase;
use Symfony\Component\HttpFoundation\Response;

class PixKeyController extends Controller
{
    public function store(PixKeyRequest $pixKeyRequest, CreateUseCase $createUseCase)
    {
        $response = $createUseCase->exec($pixKeyRequest->bank, $pixKeyRequest->kind, $pixKeyRequest->key);
        return (new PixKeyResource($response))->response()->setStatusCode(Response::HTTP_CREATED);
    }
}
