<?php

namespace App\Validator\Constraint;

use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute]
class Product extends Constraint
{
    public string $message = 'The product "{{ string }}" is invalid or does not exist.';
}