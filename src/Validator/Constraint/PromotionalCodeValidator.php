<?php

namespace App\Validator\Constraint;

use App\Repository\PromotionalCodeRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class PromotionalCodeValidator extends ConstraintValidator
{
    public function __construct(private PromotionalCodeRepository $promotionalCodeRepository)
    {
    }

    /**
     * @param string|null $value
     */
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof PromotionalCode) {
            throw new UnexpectedTypeException($constraint, PromotionalCode::class);
        }

        if (null === $value) {
            return;
        }

        if (is_string($value) && $this->promotionalCodeRepository->isCouponExist($value)) {
            return;
        }

        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ string }}', $value)
            ->addViolation()
        ;
    }
}