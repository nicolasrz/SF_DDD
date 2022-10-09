<?php

namespace App\Presentation\Api\Action\User;

use App\Domain\Exception\User\EmailAlreadyInUseExceptionInterface;
use App\Domain\UseCase\User\RegisterUserUseCase;
use App\Presentation\Api\DTO\JsonResponseFail;
use App\Presentation\Builder\User\RegisterUserRequestBuilder;
use App\Presentation\Builder\User\UserBuilder;
use App\Presentation\Specification\RequestIsValidSpecification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/register', name: 'register_user', methods: ['POST'])]
class RegisterUserAction extends AbstractController
{

    public function __construct(
        private readonly RegisterUserRequestBuilder $registerUserRequestBuilder,
        private readonly RequestIsValidSpecification $requestIsValidSpecification,
        private readonly UserBuilder $userBuilder,
        private readonly RegisterUserUseCase $useCase
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $registerUserRequest = $this->registerUserRequestBuilder->build($request);
        $requestIsValidResponse = $this->requestIsValidSpecification->check($registerUserRequest);

        if (false === $requestIsValidResponse->isValid()) {
            return (new JsonResponseFail(
                $requestIsValidResponse->getErrors()
            ))->response();
        }

        $user = $this->userBuilder->fromRegisterUserRequest($registerUserRequest);
        try {
            $this->useCase->process($user);
        } catch (EmailAlreadyInUseExceptionInterface $exception) {
            return (new JsonResponseFail(
                [$exception->getMessage()]
            ))->response();
        }

        return new JsonResponse();
    }

}