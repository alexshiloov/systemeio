<?php

namespace App\Form\DTO;

use App\Validator\Constraint as FieldAssert;
use Symfony\Component\Validator\Constraints as Assert;

class CalculatePriceDTO
{
    #[Assert\NotBlank]
    #[FieldAssert\Product]
    private int $product;

    #[Assert\NotBlank]
    #[FieldAssert\TaxNumber]
    private string $taxNumber;

    #[FieldAssert\PromotionalCode]
    private ?string $couponCode = null;

    public function getProduct(): int
    {
        return $this->product;
    }

    public function setProduct(int $product): void
    {
        $this->product = $product;
    }

    public function getTaxNumber(): string
    {
        return $this->taxNumber;
    }

    public function setTaxNumber(string $taxNumber): void
    {
        $this->taxNumber = $taxNumber;
    }

    public function getCouponCode(): ?string
    {
        return $this->couponCode;
    }

    public function setCouponCode(?string $couponCode): void
    {
        $this->couponCode = $couponCode;
    }
}