<?php

namespace App\Infrastructure\Builder\User;

use App\Domain\ValuesObject\User;
use App\Infrastructure\DAO\ORM\User as UserEntity;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserEntityBuilder
{
    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function build(User $user) : UserEntity {
        $userEntity = (new UserEntity())
            ->setEmail($user->getEmail());

        $hashedPassword = $this->passwordHasher->hashPassword(
            $userEntity,
            $user->getPassword()
        );

        $userEntity->setPassword($hashedPassword);
        return $userEntity;
    }
}