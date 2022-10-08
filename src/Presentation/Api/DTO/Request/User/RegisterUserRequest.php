<?php

namespace App\Presentation\Api\DTO\Request\User;
use App\Presentation\Api\DTO\Request\DtoRequestInterface;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterUserRequest implements DtoRequestInterface
{

    #[Assert\NotBlank]
    private readonly string $email;
    private readonly string $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
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