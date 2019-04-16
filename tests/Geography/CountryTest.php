<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography;

use Talentify\ValueObject\ValueObjectTestCase;

class CountryTest extends ValueObjectTestCase
{
    /**
     * @dataProvider countryNameDataProvider
     */
    public function testWillNormalizeCountryName(string $input, string $expected) : void
    {
        $country = new Country($input, 'fo', 'bar');

        $this->assertEquals($country->getName(), $expected);
    }

    public function countryNameDataProvider() : array
    {
        return [
            ['UnItEd STATES oF america', 'United States Of America'],
            [' brazil', 'Brazil'],
            ["brazil\r\n", 'Brazil'],
            ["bra\tzil", 'Brazil'],
        ];
    }

    public static function getClassName() : string
    {
        return Country::class;
    }

    public function sameValueDataProvider() : array
    {
        return [
            [new Country('eua ', 'us', 'usa'), new Country('eua ', 'us', 'usa')],
            [new Country('eua ', 'US', 'USA'), new Country('eua ', 'uS', 'UsA')],
        ];
    }

    public function differentValueDataProvider() : array
    {
        return [
            [new Country('Foo', 'fo', 'foo'), new Country('Baz', 'br', 'baz')],
        ];
    }

    public function invalidValueDataProvider() : array
    {
        return [
            [['', 'fo', 'bar'], null],
            [['United States', 'FooBar', 'USA'], 'The value "FooBar" is not a valid ISO 3166-1 alpha 2.'],
            [['United States', 'US', 'FooBar'], 'The value "FooBar" is not a valid ISO 3166-1 alpha 3.'],
        ];
    }
}
