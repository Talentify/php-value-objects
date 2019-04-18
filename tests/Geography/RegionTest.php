<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography;

use Talentify\ValueObject\InvalidConstructorValueAssert;
use Talentify\ValueObject\ValueObjectTestCase;

class RegionTest extends ValueObjectTestCase
{
    use InvalidConstructorValueAssert;

    public static function getClassName() : string
    {
        return Region::class;
    }

    public function sameValueDataProvider() : array
    {
        return [
            [new Region('Foo'), new Region('Foo')],
            [new Region('foo '), new Region('Foo')],

            [new Region('Foo bar'), new Region('Foo bar')],
            [new Region('Foo bar'), new Region('foo bar')],

            [new Region('Foo bar', 'Fo'), new Region('Foo bar', 'Fo')],
            [new Region('Foo bar', 'Fo'), new Region('foo bar', 'fo')],
            [new Region('Foo Bar', null), new Region('Foo bar', null)],
        ];
    }

    public function differentValueDataProvider() : array
    {
        return [
            [new Region('Foo'), new Region('Bar')],
            [new Region('Foo', null), new Region('Baz', null)],

            [new Region('Foo', 'fo'), new Region('Foo', 'ba')],
            [new Region('Foo', 'ba'), new Region('Foo', 'bz')],

            [new Region('Foo', 'fo'), new Region('Baz', 'fo')],
            [new Region('Foo', null), new Region('Baz', null)],
        ];
    }

    public function invalidValueDataProvider() : array
    {
        return [
            [['', 'fo'], 'The value "" is not a valid region name.'],
            [['United States', 'FooBar'], 'The value "FooBar" (FooBar) is not a valid ISO 3166-1 alpha 2.'],
            [['United States', ''], 'The value "" () is not a valid ISO 3166-1 alpha 2.'],
        ];
    }

    /**
     * @dataProvider regionNameDataProvider
     */
    public function testWillNormalizeRegionName(string $input, string $expected) : void
    {
        $Region = new Region($input, 'fo', 'bar');

        $this->assertEquals($Region->getName(), $expected);
    }

    /**
     * @return mixed[]
     */
    public function regionNameDataProvider() : array
    {
        return [
            ['ohio', 'Ohio'],
            ['ohio  ', 'Ohio'],
            ['new    hampshire ', 'New Hampshire'],
            ["new \n hampshire", 'New Hampshire'],
            ["new \r hampshire", 'New Hampshire'],
            ["new \t hampshire", 'New Hampshire'],
            ["new \t hampshire\r\n", 'New Hampshire'],
            ["new hampshire\n", 'New Hampshire'],
            ['U.S. virgin islands ', 'U.s. Virgin Islands'],
            ['U.S. Minor Outlying   Islands', 'U.s. Minor Outlying Islands'],
            ['Trust Territory of the Pacific Islands', 'Trust Territory Of The Pacific Islands'],
        ];
    }

    /**
     * @dataProvider isoAlpha2DataProvider
     */
    public function testWillNormalizeIsoAlpha2(string $input, string $expected) : void
    {
        $Region = new Region('Foo Bar', $input);

        $this->assertEquals($Region->getIsoAlpha2(), $expected);
    }

    /**
     * @return mixed[]
     */
    public function isoAlpha2DataProvider() : array
    {
        return [
            ['iN', 'IN'],
            ['In', 'IN'],
            ['in', 'IN'],
            ['i n', 'IN'],
            ['in ', 'IN'],
            ['i n ', 'IN'],
            ["in\n", 'IN'],
            ["in\t", 'IN'],
        ];
    }
}
