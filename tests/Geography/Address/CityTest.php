<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography\Address;

use Talentify\ValueObject\InvalidConstructorValueAssert;
use Talentify\ValueObject\ValueObjectTestCase;

class CityTest extends ValueObjectTestCase
{
    use InvalidConstructorValueAssert;

    public static function getClassName() : string
    {
        return City::class;
    }

    public function sameValueDataProvider() : array
    {
        return [
            ['foo', 'Foo'],
            ['fOo', 'Foo'],
            [' Foo', 'Foo'],
            ['Foo ', 'Foo'],
            ['fôo', 'Fôo'],
            ['foo', 'Foo'],
            ['Foo_Bar', 'Foo_Bar'],
            ['new    york ', 'New York'],
            ["new \n york", 'New York'],
            ["new \r york", 'New York'],
            ["new \t york", 'New York'],
            ["new \t york\r\n", 'New York'],
            ["new york\n", 'New York'],
        ];
    }

    public function differentValueDataProvider() : array
    {
        return [
            ['foo', 'fooBar'],
            ['fOoBaz', 'fooBar'],
        ];
    }

    public function invalidValueDataProvider() : array
    {
        return [
            ['', 'The value "" is not a valid city name.'],
            ["\t\r\n", "The value \"\t\r\n\" is not a valid city name."],
        ];
    }
}
