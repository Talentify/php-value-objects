<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography;

use PHPUnit\Framework\TestCase;

class NonFormattedAddressTest extends TestCase
{
    /**
     * @dataProvider addressesDataProvider
     */
    public function testWillNormalizeAddress(string $input, string $expected) : void
    {
        $address = new NonFormattedAddress($input);

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
}
