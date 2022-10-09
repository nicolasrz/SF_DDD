<?php

namespace App\Presentation\Builder\User;

use App\Domain\ValuesObject\User;
use App\Presentation\Api\DTO\Request\User\LoginUserRequest;
use App\Presentation\Api\DTO\Request\User\RegisterUserRequest;

class UserBuilder
{
    public function fromRegisterUserRequest(RegisterUserRequest $request) : User {
        return new User(
            $request->getEmail(), $request->getPassword()
        );
    }

    public function fromLoginUserRequest(LoginUserRequest $request) : User {
        return new User(
            $request->getEmail(), $request->getPassword()
        );
    }
}