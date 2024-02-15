<?php

namespace App\Processor\Payment;

use App\Enum\PaymentProcessorEnum;

class PaymentProcessorFactory
{
    public function __construct(
        private PaypalProcessorDecorator $paypalProcessorDecorator,
        private StripeProcessorDecorator $stripeProcessorDecorator,
    ){
    }

    public function get(PaymentProcessorEnum $paymentProcessorEnum): PaymentProcessorInterface
    {
        return match ($paymentProcessorEnum->getValue()) {
            PaymentProcessorEnum::PAYPAL => $this->paypalProcessorDecorator,
            PaymentProcessorEnum::STRIPE => $this->stripeProcessorDecorator,
            default => throw new \Exception(
                'Internal error. Not valid payment method: ' . $paymentProcessorEnum->getValue()
            ),
        };
    }
}