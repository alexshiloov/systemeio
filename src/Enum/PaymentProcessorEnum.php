<?php

namespace App\Enum;

use MyCLabs\Enum\Enum;

class PaymentProcessorEnum extends Enum
{
    public const PAYPAL = 'paypal';
    public const STRIPE = 'stripe';
}