<?php

namespace App\Validator\Constraint;

use App\Enum\PaymentProcessorEnum;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class PaymentProcessorValidator extends ConstraintValidator
{
    /**
     * @param string|null $value
     */
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof PaymentProcessor) {
            throw new UnexpectedTypeException($constraint, PaymentProcessor::class);
        }

        if (is_string($value) && PaymentProcessorEnum::isValid($value)) {
            return;
        }

        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ string }}', (string) $value)
            ->addViolation()
        ;
    }
}