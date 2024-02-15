<?php

namespace App\Exception;

use Symfony\Component\Validator\ConstraintViolationListInterface;

class FormErrorsException extends \Exception
{
    public function __construct(private ConstraintViolationListInterface $violationList)
    {
        parent::__construct();
    }

    public function getViolationList(): ConstraintViolationListInterface
    {
        return $this->violationList;
    }
}