<?php

namespace App\Presentation\Specification;

use App\Presentation\Api\DTO\Request\DtoRequestInterface;
use App\Presentation\Api\DTO\Request\User\RegisterUserRequest;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestIsValidSpecification
{
    public function __construct(private readonly ValidatorInterface $validator)
    {
    }


    /**
     * @param RegisterUserRequest $request
     * @return SpecificationResponse
     */
    public function check(DtoRequestInterface $request) : SpecificationResponse {
        $errors = $this->validator->validate($request);
        if(count($errors) > 0) {
            $errorsMessage= [];

            /** @var ConstraintViolation $error */
            foreach ($errors as $error){
                $errorsMessage[] = $error->getPropertyPath() . ' - '. $error->getMessage();
            }
            return new SpecificationResponse(false, $errorsMessage);
        }
        return new SpecificationResponse(true);
    }
}