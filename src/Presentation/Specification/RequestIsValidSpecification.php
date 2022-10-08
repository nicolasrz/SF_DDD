<?php

namespace App\Presentation\Specification;

use App\Presentation\Api\DTO\Request\DtoRequestInterface;

interface RequestIsValidSpecification
{
    public function check(DtoRequestInterface $request) : SpecificationResponse;
}