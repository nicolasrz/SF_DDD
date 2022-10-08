<?php

namespace App\Presentation\Specification;

use Throwable;

class SpecificationResponse
{


    public function __construct(private readonly bool $valid, private readonly array $errors = [])
    {
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->valid;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }




}