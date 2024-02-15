<?php

namespace App\Processor\Payment;

use App\Exception\PaymentException;
use App\PaymentProcessor\PaypalPaymentProcessor;

class PaypalProcessorDecorator implements PaymentProcessorInterface
{
    public function __construct(private PaypalPaymentProcessor $bundleProcessor)
    {
    }

    public function pay(float $price): void
    {
        try {
            $this->bundleProcessor->pay((int) $price);
        } catch (\Throwable) {
            throw new PaymentException();
        }
    }
}