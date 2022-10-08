<?php

namespace App\Domain\Repository;

use App\Domain\Exception\User\EmailAlreadyInUseExceptionInterface;
use App\Domain\ValuesObject\User;

interface UserRepositoryInterface
{
    /**
     * @throws EmailAlreadyInUseExceptionInterface
     * @param User $user
     * @return void
     */
    public function save(User $user) : void;
}