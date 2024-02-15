<?php

namespace App\Enum;

use MyCLabs\Enum\Enum;

class TaxCountryEnum extends Enum
{
    public const DE = 'DE';
    public const IT = 'IT';
    public const FR = 'FR';
    public const GR = 'GR';

    public static function getTaxPercent(TaxCountryEnum $taxCountryEnum): ?float
    {
        return match ($taxCountryEnum->getValue()) {
            self::DE => 19,
            self::IT => 22,
            self::GR => 24,
            self::FR => 20,
            default => null,
        };
    }

    public static function getFromTaxNumber(string $taxNumber): ?self
    {
        $countryCode = substr($taxNumber, 0, 2);
        if (TaxCountryEnum::isValid($countryCode)) {
            return new TaxCountryEnum($countryCode);
        }

        return null;
    }
}