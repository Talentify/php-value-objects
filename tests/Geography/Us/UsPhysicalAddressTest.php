<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography\Us;

use Talentify\ValueObject\Geography\City;
use Talentify\ValueObject\Geography\Region;
use Talentify\ValueObject\Geography\Street;
use Talentify\ValueObject\ValueObjectTestCase;

class UsPhysicalAddressTest extends ValueObjectTestCase
{
    public static function getClassName() : string
    {
        return UsPhysicalAddress::class;
    }

    public function sameValueDataProvider() : array
    {
        return [
            [
                new UsPhysicalAddress(
                    new Street('foo', 'bar', 'baz'),
                    new City('Seattle'),
                    new Region('Washington'),
                    null
                ),
                new UsPhysicalAddress(
                    new Street('foo', 'bar', 'baz'),
                    new City('Seattle'),
                    new Region('Washington'),
                    null
                ),
            ],
        ];
    }

    public function differentValueDataProvider() : array
    {
        return [
            [
                new UsPhysicalAddress(
                    new Street('foo1', 'bar', 'baz'),
                    new City('Seattle'),
                    new Region('Washington'),
                    null
                ),
                new UsPhysicalAddress(
                    new Street('foo2', 'bar', 'baz'),
                    new City('Seattle'),
                    new Region('Washington'),
                    null
                ),
            ],
        ];
    }
}
