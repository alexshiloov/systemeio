<?php

namespace App\Validator\Constraint;

use App\Repository\ProductRepository;
use App\Validator\TaxNumberValidator as TaxValidator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class ProductValidator extends ConstraintValidator
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    /**
     * @param int|null $value
     */
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof Product) {
            throw new UnexpectedTypeException($constraint, Product::class);
        }

        if (is_int($value) && $this->productRepository->isExist($value)) {
            return;
        }

        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ string }}', (string) $value)
            ->addViolation()
        ;
    }
}