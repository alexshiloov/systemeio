<?php

namespace App\Validator\Constraint;

use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute]
class TaxNumber extends Constraint
{
    public string $message = 'The tax number "{{ string }}" is invalid.';
}