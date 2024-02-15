<?php

namespace App\Processor;

use App\DTO\PromotionalCodeDTO;
use App\Enum\PromotionalCodeTypeEnum;
use App\Enum\TaxCountryEnum;

class PriceCalculator
{
    public function calculate(
        TaxCountryEnum $taxCountryEnum,
        float $productPrice,
        ?PromotionalCodeDTO $promotionalCodeDTO,
    ): float {
        $totalPrice = $productPrice;
        if (null !== $promotionalCodeDTO) {
            if ($promotionalCodeDTO->getType()->equals(PromotionalCodeTypeEnum::FIX())) {
                $totalPrice -= $promotionalCodeDTO->getAmount();
            }

            if ($promotionalCodeDTO->getType()->equals(PromotionalCodeTypeEnum::PERCENT())) {
                $totalPrice = $totalPrice * (1 - $promotionalCodeDTO->getAmount() / 100);
            }
        }

        return $totalPrice * (1 + TaxCountryEnum::getTaxPercent($taxCountryEnum) / 100);
    }
}