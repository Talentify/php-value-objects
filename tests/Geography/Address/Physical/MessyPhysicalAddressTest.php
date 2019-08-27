<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography\Address\Physical;

use Talentify\ValueObject\Geography\Address\City;
use Talentify\ValueObject\Geography\Address\Region;
use Talentify\ValueObject\Geography\CountryList;
use Talentify\ValueObject\ValueObjectTestCase;

class MessyPhysicalAddressTest extends ValueObjectTestCase
{
    /**
     * @dataProvider formattedAddressDataProvider
     */
    public function testWillGetFormattedAddress(MessyPhysicalAddress $messyAddress, string $expected) : void
    {
        $this->assertEquals($expected, $messyAddress->getAddress());
    }

    public function formattedAddressDataProvider() : array
    {
        return [
            [
                new MessyPhysicalAddress('400 broad St, seattle'),
                '400 Broad St, Seattle'
            ],
            [
                new MessyPhysicalAddress('washington', null, new Region('king county')),
                'Washington, King County'
            ],
            [
                new MessyPhysicalAddress(
                    '400 broad st',
                    new City('Seattle'),
                    new Region('Washington'),
                    CountryList::US()
                ),
                '400 Broad St, Seattle, Washington, US'
            ],
            [
                new MessyPhysicalAddress('São Paulo, SP', new City('São Paulo'), new Region('SP')),
                'São Paulo, Sp',
            ],
            [
                new MessyPhysicalAddress('Morristown, Nj', new City('Morristown'), new Region('NJ')),
                'Morristown, Nj',
            ]
        ];
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
