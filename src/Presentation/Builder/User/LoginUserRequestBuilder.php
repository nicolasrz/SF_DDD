<?php

namespace App\Presentation\Builder\User;

use App\Presentation\Api\DTO\Request\User\LoginUserRequest;
use App\Presentation\Api\DTO\Request\User\RegisterUserRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class LoginUserRequestBuilder
{

    public function __construct(private readonly SerializerInterface $serializer)
    {
    }

    public function build(Request $request): LoginUserRequest
    {
        return $this->serializer->deserialize((string)$request->getContent(), LoginUserRequest::class, JsonEncoder::FORMAT);
    }
}