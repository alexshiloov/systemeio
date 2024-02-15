<?php

namespace App\Validator\Constraint;

use App\Validator\TaxNumberValidator as TaxValidator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class TaxNumberValidator extends ConstraintValidator
{
    public function __construct(private TaxValidator $validator)
    {
    }

    /**
     * @param string|null $value
     */
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof TaxNumber) {
            throw new UnexpectedTypeException($constraint, TaxNumber::class);
        }

        if (is_string($value) && $this->validator->isValid($value)) {
            return;
        }

        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ string }}', (string) $value)
            ->addViolation()
        ;
    }
}