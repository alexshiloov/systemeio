<?php

namespace App\Processor\Payment;

interface PaymentProcessorInterface
{
    public function pay(float $price): void;
}