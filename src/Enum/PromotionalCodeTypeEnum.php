<?php

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static PromotionalCodeTypeEnum FIX()
 * @method static PromotionalCodeTypeEnum PERCENT()
 */
class PromotionalCodeTypeEnum extends Enum
{
    public const FIX = 'fix';
    public const PERCENT = 'percent';
}