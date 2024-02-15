<?php

namespace App\Validator;

use App\Enum\TaxCountryEnum;

class TaxNumberValidator
{
    public function isValid(string $taxNumber): bool
    {
        $countryCode = substr($taxNumber, 0, 2);
        switch ($countryCode) {
            case TaxCountryEnum::DE:
            case TaxCountryEnum::GR:
                if (11 !== strlen($taxNumber)) {
                    return false;
                }
                $secondPartCode = substr($taxNumber, 2);

                return is_numeric($secondPartCode);
            case TaxCountryEnum::IT:
                if (13 !== strlen($taxNumber)) {
                    return false;
                }
                $secondPartCode = substr($taxNumber, 2);

                return is_numeric($secondPartCode);
            case TaxCountryEnum::FR:
                if (13 !== strlen($taxNumber)) {
                    return false;
                }
                $secondPartCode = substr($taxNumber, 2, 2);
                if (!ctype_alpha($secondPartCode)) {
                    return false;
                }

                $thirdPartCode = substr($taxNumber, 4);

                return is_numeric($thirdPartCode);
            default:
                return false;
        }
    }
}