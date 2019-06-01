<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography\Address\Physical;

use Talentify\ValueObject\Geography\Address\City;
use Talentify\ValueObject\Geography\Address\Region;
use Talentify\ValueObject\Geography\CountryList;
use Talentify\ValueObject\ValueObjectTestCase;

class MessyPhysicalAddressTest extends ValueObjectTestCase
{
    public function testWillGetFormattedAddress() : void
    {
        $messyAddress = new MessyPhysicalAddress('400 broad St, seattle');
        $this->assertEquals('400 Broad St, Seattle', $messyAddress->getAddress());

        $messyAddress = new MessyPhysicalAddress('washington', null, new Region('king county'));
        $this->assertEquals('Washington, King County', $messyAddress->getAddress());

        $messyAddress = new MessyPhysicalAddress('400 broad st', new City('Seattle'), new Region('Washington'), CountryList::US());
        $this->assertEquals('400 Broad St, Seattle, Washington, US', $messyAddress->getAddress());
    }

    /**
     * @dataProvider addressesDataProvider
     */
    public function testWillNormalizeAddress(string $input, string $expected) : void
    {
        $address = new MessyPhysicalAddress($input);

        $this->assertEquals($expected, $address->getAddress());
        $this->assertEquals($expected, $address->__toString());
    }

    public function addressesDataProvider() : array
    {
        return [
            ['Seattle     Washington', 'Seattle Washington'],
            ['Seattle   WashinGtoN', 'Seattle Washington'],
        ];
    }

    public static function getClassName() : string
    {
        return MessyPhysicalAddress::class;
    }

    /**
     * @return mixed[]
     */
    public function sameValueDataProvider() : array
    {
        return [
            [
                new MessyPhysicalAddress(
                    'Foo bar Baz'
                ),
                new MessyPhysicalAddress(
                    'foo bar baz'
                ),
            ],
            [
                new MessyPhysicalAddress(
                    'Seattle',
                    new City('Seattle')
                ),
                new MessyPhysicalAddress(
                    'Seattle',
                    new City('seattle')
                ),
            ],
            [
                new MessyPhysicalAddress(
                    'Seattle',
                    new City('Seattle'),
                    new Region('King County')
                ),
                new MessyPhysicalAddress(
                    'Seattle',
                    new City('seattle'),
                    new Region('king County')
                ),
            ],
        ];
    }

    /**
     * @return mixed[]
     */
    public function differentValueDataProvider() : array
    {
        return [
            [
                new MessyPhysicalAddress(
                    'Foo bar Baz'
                ),
                new MessyPhysicalAddress(
                    'foo bar bazzzz'
                ),
            ],
            [
                new MessyPhysicalAddress(
                    'Seattle Washington',
                    new City('Seattle')
                ),
                new MessyPhysicalAddress(
                    'Seattle',
                    new City('seattle')
                ),
            ],
            [
                new MessyPhysicalAddress(
                    'Seattle Washington',
                    null,
                    new Region('king County')
                ),
                new MessyPhysicalAddress(
                    'Seattle',
                    new City('seattle')
                ),
            ],
            [
                new MessyPhysicalAddress(
                    'Seattle',
                    new City('Seattle')
                ),
                new MessyPhysicalAddress(
                    'Seattle',
                    new City('seattle'),
                    new Region('king County')
                ),
            ],
        ];
    }
}
