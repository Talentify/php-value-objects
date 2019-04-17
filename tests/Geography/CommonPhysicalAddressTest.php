<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography;

use Talentify\ValueObject\ValueObjectTestCase;

class CommonPhysicalAddressTest extends ValueObjectTestCase
{
    public static function getClassName() : string
    {
        return CommonPhysicalAddress::class;
    }

    public function sameValueDataProvider() : array
    {
        return [
            [
                new CommonPhysicalAddress(
                    new Street('foo', 'bar', 'baz'),
                    new District('fooBar'),
                    new City('Seattle'),
                    new Region('Washington'),
                    CountryList::US()
                ),
                new CommonPhysicalAddress(
                    new Street('foo', 'bar', 'baz'),
                    new District('fooBar'),
                    new City('Seattle'),
                    new Region('Washington'),
                    CountryList::US()
                )
            ],
        ];
    }

    public function differentValueDataProvider() : array
    {
        return [
            [
                new CommonPhysicalAddress(
                    new Street('foo1', 'bar', 'baz'),
                    new District('fooBar'),
                    new City('Seattle'),
                    new Region('Washington'),
                    CountryList::US()
                ),
                new CommonPhysicalAddress(
                    new Street('foo2', 'bar', 'baz'),
                    new District('fooBar'),
                    new City('Seattle'),
                    new Region('Washington'),
                    CountryList::US()
                )
            ],
        ];
    }
}
