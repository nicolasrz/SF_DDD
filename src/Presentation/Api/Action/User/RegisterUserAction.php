<?php

namespace App\Presentation\Api\Action\User;

use App\Domain\Exception\User\EmailAlreadyInUseExceptionInterface;
use App\Domain\UseCase\User\RegisterUserUseCase;
use App\Presentation\Api\DTO\JsonResponseFail;
use App\Presentation\Builder\User\RegisterUserRequestBuilder;
use App\Presentation\Builder\User\UserBuilder;
use App\Presentation\Responder\JsonResponder;
use App\Presentation\Responder\ResponderInterface;
use App\Presentation\Specification\User\RegisterUserRequestIsValidSpecification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class RegisterUserAction extends AbstractController
{


    public function __construct(
        private readonly RegisterUserRequestBuilder $registerUserRequestBuilder,
        private readonly RegisterUserRequestIsValidSpecification $registerUserRequestIsValidSpecification,
        private readonly UserBuilder $userBuilder,
        private readonly RegisterUserUseCase $useCase
    )
    {
    }

    #[Route(path:'/register', name: 'register_user', methods: ['POST'])]
    public function __invoke(Request $request) : JsonResponse
    {
        $registerUserRequest = $this->registerUserRequestBuilder->build($request);
        $isValidRequest = $this->registerUserRequestIsValidSpecification->check($registerUserRequest);

        if(false === $isValidRequest->isValid()) {
            return (new JsonResponseFail(
                $isValidRequest->getErrors()
            ))->response();
        }

        $user = $this->userBuilder->build($registerUserRequest);
        try{
        $this->useCase->process($user);
        }catch (EmailAlreadyInUseExceptionInterface $exception) {
            return (new JsonResponseFail(
                [$exception->getMessage()]
            ))->response();
        }

        return new JsonResponse();
    }

}