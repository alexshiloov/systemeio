<?php

namespace App\DTO;

use App\Enum\PromotionalCodeTypeEnum;

class PromotionalCodeDTO
{
    public function __construct(
        private PromotionalCodeTypeEnum $type,
        private string $name,
        private int $amount,
    ){
    }

    public function getType(): PromotionalCodeTypeEnum
    {
        return $this->type;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getName(): string
    {
        return $this->name;
    }
}