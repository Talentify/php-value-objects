<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography\Address\Physical;

use Talentify\ValueObject\Geography\Address\City as BaseCity;
use Talentify\ValueObject\Geography\Address\PostalCode as BasePostalCode;
use Talentify\ValueObject\Geography\Address\Region as BaseRegion;
use Talentify\ValueObject\Geography\Address\Street as BaseStreet;
use Talentify\ValueObject\Geography\CountryList;
use Talentify\ValueObject\ValueObjectTestCase;

class BasePhysicalAddressTest extends ValueObjectTestCase
{
    public static function getClassName() : string
    {
        return BasePhysicalAddress::class;
    }

    public function sameValueDataProvider() : array
    {
        return [
            [
                new BasePhysicalAddress(
                    new BaseStreet('foo', 'bar', 'baz'),
                    new BaseCity('Seattle'),
                    new BaseRegion('Washington'),
                    new BasePostalCode('06473-073'),
                    CountryList::US()
                ),
                new BasePhysicalAddress(
                    new BaseStreet('foo', 'bar', 'baz'),
                    new BaseCity('Seattle'),
                    new BaseRegion('Washington'),
                    new BasePostalCode('06473-073'),
                    CountryList::US()
                ),
            ],
        ];
    }

    public function differentValueDataProvider() : array
    {
        return [
            [
                new BasePhysicalAddress(
                    new BaseStreet('foo1', 'bar', 'baz'),
                    new BaseCity('Seattle'),
                    new BaseRegion('Washington'),
                    new BasePostalCode('06473-073'),
                    CountryList::US()
                ),
                new BasePhysicalAddress(
                    new BaseStreet('foo2', 'bar', 'baz'),
                    new BaseCity('Seattle'),
                    new BaseRegion('Washington'),
                    new BasePostalCode('06473-074'),
                    CountryList::US()
                ),
            ],
        ];
    }
}
