<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography;

use Talentify\ValueObject\InvalidConstructorValueAssert;
use Talentify\ValueObject\ValueObjectTestCase;

class CountryTest extends ValueObjectTestCase
{
    use InvalidConstructorValueAssert;

    public static function getClassName() : string
    {
        return Country::class;
    }

    public function sameValueDataProvider() : array
    {
        return [
            [new Country('Foo'), new Country('Foo')],
            [new Country('foo '), new Country('Foo')],

            [new Country('Foo bar'), new Country('Foo bar')],
            [new Country('Foo bar'), new Country('foo bar')],

            [new Country('Foo bar', 'Fo'), new Country('Foo bar', 'Fo')],
            [new Country('Foo bar', 'Fo'), new Country('foo bar', 'fo')],

            [new Country('Foo', 'Fo', 'BAZ'), new Country('Foo', 'Fo', 'BAZ')],
            [new Country('Foo', 'Fo', 'BAZ'), new Country('Foo', 'Fo', 'BaZ')],
            [new Country('Foo Bar', 'fO', 'bAz'), new Country('Foo bar', 'fo', 'baz')],
            [new Country('Foo Bar', null, 'bAz'), new Country('Foo bar', null, 'baz')],
        ];
    }

    public function differentValueDataProvider() : array
    {
        return [
            [new Country('Foo'), new Country('Bar')],

            [new Country('Foo', 'fo'), new Country('Foo', 'ba')],
            [new Country('Foo', 'ba'), new Country('Foo', 'bz')],

            [new Country('Foo', 'fo', 'bar'), new Country('Baz', 'fo', 'baz')],
            [new Country('Foo', null, 'bar'), new Country('Baz', null, 'baz')],

            [new Country('Foo', null, null), new Country('Baz', null, null)],
        ];
    }

    /**
     * @return mixed[]
     */
    public function invalidValueDataProvider() : array
    {
        return [
            [['', 'fo', 'bar'], null],
            [['United States', 'FooBar', 'USA'], 'The value "FooBar" (FooBar) is not a valid ISO 3166-1 alpha 2.'],
            [['United States', 'US', 'FooBar'], 'The value "FooBar" (FooBar) is not a valid ISO 3166-1 alpha 3.'],
        ];
    }

    /**
     * @dataProvider countryNameDataProvider
     */
    public function testWillNormalizeCountryName(string $input, string $expected) : void
    {
        $country = new Country($input, 'fo', 'bar');

        $this->assertEquals($country->getName(), $expected);
    }

    /**
     * @return mixed[]
     */
    public function countryNameDataProvider() : array
    {
        return [
            ['UnItEd STATES oF america', 'United States Of America'],
            [' brazil', 'Brazil'],
            ["brazil\r\n", 'Brazil'],
            ["bra\tzil", 'Brazil'],
        ];
    }

    /**
     * @dataProvider isoAlpha2DataProvider
     */
    public function testWillNormalizeIsoAlpha2(string $input, string $expected) : void
    {
        $country = new Country('Foo Bar', $input);

        $this->assertEquals($country->getIsoAlpha2(), $expected);
    }

    /**
     * @return mixed[]
     */
    public function isoAlpha2DataProvider() : array
    {
        return [
            ['uS', 'US'],
            ['Us', 'US'],
            ['us', 'US'],
            ['u s', 'US'],
            ['us ', 'US'],
            ['u s ', 'US'],
            ["us\n", 'US'],
            ["us\t", 'US'],
        ];
    }

    /**
     * @dataProvider isoAlpha3DataProvider
     */
    public function testWillNormalizeIsoAlpha3(string $input, string $expected) : void
    {
        $country = new Country('Foo Bar', null, $input);

        $this->assertEquals($country->getIsoAlpha3(), $expected);
    }

    /**
     * @return mixed[]
     */
    public function isoAlpha3DataProvider() : array
    {
        return [
            ['uSA', 'USA'],
            ['UsA', 'USA'],
            ['usa', 'USA'],
            ['u s a', 'USA'],
            ['usa ', 'USA'],
            ['u sa ', 'USA'],
            ["usa\n", 'USA'],
            ["usa\t", 'USA'],
        ];
    }
}
