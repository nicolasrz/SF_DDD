<?php

namespace App\Presentation\Api\Action\User;

use App\Domain\UseCase\User\LoginUserUseCase;
use App\Presentation\Api\DTO\JsonResponseFail;
use App\Presentation\Builder\User\LoginUserRequestBuilder;
use App\Presentation\Builder\User\UserBuilder;
use App\Presentation\Specification\RequestIsValidSpecification;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/login', name: 'login_user', methods: ['POST'])]
class LoginUserAction
{


    public function __construct(
        private readonly LoginUserRequestBuilder $loginUserRequestBuilder,
        private readonly RequestIsValidSpecification $requestIsValidSpecification,
        private readonly UserBuilder $userBuilder,
        private readonly LoginUserUseCase $useCase
    )
    {
    }

    public function __invoke(Request $request)
    {
        $loginUserRequest = $this->loginUserRequestBuilder->build($request);
        $requestIsValidResponse = $this->requestIsValidSpecification->check($loginUserRequest);

        if (false === $requestIsValidResponse->isValid()) {
            return (new JsonResponseFail(
                $requestIsValidResponse->getErrors()
            ))->response();
        }

        $user = $this->userBuilder->fromLoginUserRequest($loginUserRequest);
        $this->useCase->process($user);

    }

}