<?php

namespace App\Validator\Constraint;

use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute]
class PaymentProcessor extends Constraint
{
    public string $message = 'The payment processor "{{ string }}" is invalid.';
}