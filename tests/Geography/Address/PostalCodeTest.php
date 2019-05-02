<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography\Address;

use Talentify\ValueObject\InvalidConstructorValueAssert;
use Talentify\ValueObject\ValueObjectTestCase;

class PostalCodeTest extends ValueObjectTestCase
{
    use InvalidConstructorValueAssert;

    public function testCanNotUseInteger() : void
    {
        $this->expectException(\TypeError::class);

        new PostalCode(55416);
    }

    public static function getClassName() : string
    {
        return PostalCode::class;
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
        ];
    }
}
