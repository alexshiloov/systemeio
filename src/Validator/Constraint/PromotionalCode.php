<?php

namespace App\Validator\Constraint;

use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute]
class PromotionalCode extends Constraint
{
    public string $message = 'The promotional code "{{ string }}" is invalid or does not exist.';
}