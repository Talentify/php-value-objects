<?php

namespace Talentify\ValueObject\Geography\Address\ByCountry\Us;

use Talentify\ValueObject\ValueObjectTestCase;

class ZipcodeTest extends ValueObjectTestCase
{

    public function testAddZeroToTheLeftInteger() : void
    {
        $zipcode = new ZipCode('1234');

        $this->assertSame('01234', $zipcode->getValue());
    }

    public static function getClassName() : string
    {
        return ZipCode::class;
    }

    public function sameValueDataProvider() : array
    {
        return [
            ["55416\n", '55416'],
            ["55416\r", '55416'],
            ["55416\t", '55416'],
            ["55416\r\n", '55416'],
            ["554\t16", '55416'],
            ['55416', '55416'],
            ['99750-0077', '99750-0077']
        ];
    }

    public function differentValueDataProvider() : array
    {
        return [
            ['55416', '12345'],
        ];
    }

    public function invalidValueDataProvider() : array
    {
        return [
            ['', 'The value "" is not a valid postal code.'],
            ["\t\r\n", "The value \"\t\r\n\" is not a valid postal code."],
            ['235-895', 'The value "235895" is not a valid postal code.']
        ];
    }
}
