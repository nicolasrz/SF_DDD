<?php

namespace App\Presentation\Api\DTO\Request\User;

use App\Presentation\Api\DTO\Request\DtoRequestInterface;
use Symfony\Component\Validator\Constraints as Assert;

class LoginUserRequest implements DtoRequestInterface
{
    #[Assert\NotBlank]
    #[Assert\Email]
    private ?string $email = null;

    #[Assert\NotBlank]
    private ?string $password = null;

    public function __construct(?string $email, ?string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }
}