<?php

namespace App\Tests\Processor;

use App\DTO\PromotionalCodeDTO;
use App\Enum\PromotionalCodeTypeEnum;
use App\Enum\TaxCountryEnum;
use App\Processor\PriceCalculator;
use PHPUnit\Framework\TestCase;

class PriceCalculatorTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testCalculate(
        TaxCountryEnum $taxCountryEnum,
        ?PromotionalCodeDTO $promotionalCodeDTO,
        float $expected,
    ): void
    {
        $calculator = new PriceCalculator();
        $this->assertSame(
            $expected,
            $calculator->calculate(
                taxCountryEnum: $taxCountryEnum,
                productPrice: 100,
                promotionalCodeDTO: $promotionalCodeDTO,
            )
        );
    }

    /**
     * @return mixed[]
     */
    public static function dataProvider(): iterable
    {
        return [
            'without promotion code' => [
                'taxCountryEnum' => TaxCountryEnum::IT(),
                'promotionalCodeDTO' => null,
                'expected' => 122,
            ],
            'with fix promotion code' => [
                'taxCountryEnum' => TaxCountryEnum::DE(),
                'promotionalCodeDTO' => new PromotionalCodeDTO(
                    type: PromotionalCodeTypeEnum::FIX(),
                    name: 'name',
                    amount: 7,
                ),
                'expected' => 110.67,
            ],
            'with percent promotion code' => [
                'taxCountryEnum' => TaxCountryEnum::GR(),
                'promotionalCodeDTO' => new PromotionalCodeDTO(
                    type: PromotionalCodeTypeEnum::PERCENT(),
                    name: 'name',
                    amount: 10,
                ),
                'expected' => 111.6,
            ],
            'france tax' => [
                'taxCountryEnum' => TaxCountryEnum::FR(),
                'promotionalCodeDTO' => new PromotionalCodeDTO(
                    type: PromotionalCodeTypeEnum::PERCENT(),
                    name: 'name',
                    amount: 20,
                ),
                'expected' => 96.0,
            ],
        ];
    }
}