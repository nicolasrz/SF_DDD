<?php

namespace App\Presentation\Api\DTO;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JsonResponseSuccess
{
    public function __construct(
        private readonly ?array $data = []
    )
    {
    }

    public function response(?int $httpStatus = Response::HTTP_OK): JsonResponse
    {
        return new JsonResponse([
            'success' => true,
            'data' => $this->data
        ], $httpStatus);
    }
}