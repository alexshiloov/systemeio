<?php

namespace App\Tests\Validator;

use App\Validator\TaxNumberValidator;
use PHPUnit\Framework\TestCase;

class TaxNumberValidatorTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testValidate(
        string $taxNumber,
        bool $expected,
    ): void
    {
        $validator = new TaxNumberValidator();
        $this->assertSame($expected, $validator->isValid($taxNumber));
    }

    /**
     * @return mixed[]
     */
    public static function dataProvider(): iterable
    {
        return [
            'de correct' => [
                'taxNumber' => 'DE123456789',
                'expected' => true,
            ],
            'de incorrect 1' => [
                'taxNumber' => 'DE1A3456789',
                'expected' => false,
            ],
            'de incorrect 2' => [
                'taxNumber' => 'DE13456789',
                'expected' => false,
            ],
            'it correct' => [
                'taxNumber' => 'IT12345678900',
                'expected' => true,
            ],
            'it correct 1' => [
                'taxNumber' => 'IT13456789A00',
                'expected' => false,
            ],
            'it correct 2' => [
                'taxNumber' => 'IT1345678900',
                'expected' => false,
            ],
            'gr correct' => [
                'taxNumber' => 'GR123456789',
                'expected' => true,
            ],
            'gr incorrect 1' => [
                'taxNumber' => 'GR1234B6789',
                'expected' => false,
            ],
            'gr incorrect 2' => [
                'taxNumber' => 'GR12346789',
                'expected' => false,
            ],
            'fr correct' => [
                'taxNumber' => 'FRAB123456789',
                'expected' => true,
            ],
            'fr incorrect 1' => [
                'taxNumber' => 'FR12123456789',
                'expected' => false,
            ],
            'fr incorrect 2' => [
                'taxNumber' => 'FR1B123456789',
                'expected' => false,
            ],
            'fr incorrect 3' => [
                'taxNumber' => 'FRAB23456789',
                'expected' => false,
            ],
        ];
    }
}