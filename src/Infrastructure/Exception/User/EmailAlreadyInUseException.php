<?php

namespace App\Infrastructure\Exception\User;

use App\Domain\Exception\User\EmailAlreadyInUseExceptionInterface;
use Exception;

class EmailAlreadyInUseException extends Exception implements EmailAlreadyInUseExceptionInterface
{

    public function __construct()
    {
        parent::__construct('Email already in use');
    }


}