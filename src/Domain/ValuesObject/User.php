<?php

namespace App\Domain\ValuesObject;

class User
{

    public function __construct(
        private readonly string $email,
        private readonly string $password
        )
    {
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }


}