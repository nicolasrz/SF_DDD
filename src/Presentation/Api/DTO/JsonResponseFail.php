<?php

namespace App\Presentation\Api\DTO;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JsonResponseFail
{
    public function __construct(
        private readonly ?array $data = [],
        private readonly ?int $code = 0
    )
    {
    }

    public function response(?int $httpStatus = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return new JsonResponse([
            'success' => false,
            'errors' => $this->data,
            'code' => $this->code
        ], $httpStatus);
    }
}