<?php

namespace App\Form\DTO;

use App\Validator\Constraint as FieldAssert;
use Symfony\Component\Validator\Constraints as Assert;

class PurchaseDTO
{
    #[Assert\NotBlank]
    #[FieldAssert\Product]
    private int $product;

    #[Assert\NotBlank]
    #[FieldAssert\TaxNumber]
    private string $taxNumber;

    #[FieldAssert\PromotionalCode]
    private ?string $couponCode = null;

    #[Assert\NotBlank]
    #[FieldAssert\PaymentProcessor]
    private string $paymentProcessor;

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

    public function getPaymentProcessor(): string
    {
        return $this->paymentProcessor;
    }

    public function setPaymentProcessor(string $paymentProcessor): void
    {
        $this->paymentProcessor = $paymentProcessor;
    }
}