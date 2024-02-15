<?php

namespace App\Processor\Payment;

use App\Exception\PaymentException;
use App\PaymentProcessor\StripePaymentProcessor;

class StripeProcessorDecorator implements PaymentProcessorInterface
{
    public function __construct(private StripePaymentProcessor $bundleProcessor)
    {
    }

    public function pay(float $price): void
    {
        if (!$this->bundleProcessor->processPayment($price)) {
            throw new PaymentException();
        }
    }
}