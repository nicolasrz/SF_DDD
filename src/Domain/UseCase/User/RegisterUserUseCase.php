<?php

namespace App\Domain\UseCase\User;

use App\Domain\Exception\User\EmailAlreadyInUseExceptionInterface;
use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\ValuesObject\User;

class RegisterUserUseCase
{

    public function __construct(private readonly UserRepositoryInterface $repository)
    {
    }

    /**
     * @throws EmailAlreadyInUseExceptionInterface
     * @param User $user
     * @return void
     */
    public function process(User $user){
        $this->repository->save($user);
    }
}