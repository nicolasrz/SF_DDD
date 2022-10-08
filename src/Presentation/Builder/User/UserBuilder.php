<?php

namespace App\Presentation\Builder\User;

use App\Domain\ValuesObject\User;
use App\Presentation\Api\DTO\Request\User\RegisterUserRequest;

class UserBuilder
{
    public function build(RegisterUserRequest $request) : User {
        return new User(
            $request->getEmail(), $request->getPassword()
        );
    }
}