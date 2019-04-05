<?php

declare(strict_types=1);

namespace Tfy\ValueObject\Geography;

use Tfy\ValueObject\ValueObjectTestCase;

class RegionTest extends ValueObjectTestCase
{
    public static function getClassName() : string
    {
        return Region::class;
    }

    public function sameValueDataProvider() : array
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

    public function differentValueDataProvider() : array
    {
        return [
            ['foo', 'fooBar'],
            ['New Hampshire', 'New York'],
        ];
    }

    public function invalidValueDataProvider() : array
    {
        return [
            ['', 'The value "" is not a valid region name.'],
            ["\t\r\n", "The value \"\t\r\n\" is not a valid region name."],
        ];
    }
}
