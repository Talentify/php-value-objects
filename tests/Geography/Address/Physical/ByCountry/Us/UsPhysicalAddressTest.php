<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography\Address\Physical\ByCountry\Us;

use Talentify\ValueObject\Geography\Address\ByCountry\Us\State;
use Talentify\ValueObject\Geography\Address\ByCountry\Us\ZipCode;
use Talentify\ValueObject\Geography\Address\City as BaseCity;
use Talentify\ValueObject\Geography\Address\Street as BaseStreet;
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
                    new BaseStreet('foo', 'bar', 'baz'),
                    new BaseCity('Seattle'),
                    new State('Washington'),
                    null
                ),
                new UsPhysicalAddress(
                    new BaseStreet('foo', 'bar', 'baz'),
                    new BaseCity('Seattle'),
                    new State('Washington'),
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
                    new BaseStreet('foo1', 'bar', 'baz'),
                    new BaseCity('Seattle'),
                    new State('Washington'),
                    new ZipCode('01234567')
                ),
                new UsPhysicalAddress(
                    new BaseStreet('foo2', 'bar', 'baz'),
                    new BaseCity('Seattle'),
                    new State('Washington'),
                    null
                ),
            ],
            [
                new UsPhysicalAddress(
                    new BaseStreet('foo1', 'bar', 'baz'),
                    new BaseCity('Seattle'),
                    null,
                    new ZipCode('01234567')
                ),
                new UsPhysicalAddress(
                    new BaseStreet('foo2', 'bar', 'baz'),
                    new BaseCity('Seattle'),
                    new State('Washington'),
                    null
                ),
            ],
            [
                new UsPhysicalAddress(
                    new BaseStreet('foo1', 'bar', 'baz'),
                    new BaseCity('Seattle'),
                    new State('Washington'),
                    new ZipCode('01234567')
                ),
                new UsPhysicalAddress(
                    new BaseStreet('foo2', 'bar', 'baz'),
                    null,
                    null,
                    null
                ),
            ],
        ];
    }
}
