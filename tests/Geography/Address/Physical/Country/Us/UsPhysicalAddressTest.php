<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography\Address\Physical\Country\Us;

use Talentify\ValueObject\Geography\Address\City as BaseCity;
use Talentify\ValueObject\Geography\Address\Country\Us\ZipCode;
use Talentify\ValueObject\Geography\Address\Street as BaseStreet;
use Talentify\ValueObject\Geography\Address\Country\Us\State;
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
        ];
    }
}
