<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography\Address\Physical;

use PHPUnit\Framework\TestCase;

class MessyPhysicalAddressTest extends TestCase
{
    /**
     * @dataProvider addressesDataProvider
     */
    public function testWillNormalizeAddress(string $input, string $expected) : void
    {
        $address = new MessyPhysicalAddress($input);

        $this->assertEquals($expected, $address->getFormattedAddress());
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
