<?php

declare(strict_types=1);

namespace Tfy\ValueObject\Geography;

use Tfy\ValueObject\ValueObjectTestCase;

class CountryTest extends ValueObjectTestCase
{
    public static function getClassName() : string
    {
        return Country::class;
    }

    public function sameValueDataProvider() : array
    {
        return [
            ['eua ', 'Eua'],
            ['UnItEd STATES oF america', 'United States Of America'],
            [' brazil', 'Brazil'],
            ["brazil\r\n", 'Brazil'],
            ["bra\tzil", 'Brazil'],
        ];
    }

    public function differentValueDataProvider() : array
    {
        return [
            ['brazil', 'brazilzil'],
            ['fOoBaz', 'fooBar'],
        ];
    }

    public function invalidValueDataProvider() : array
    {
        return [
            ['', 'The value "" is not a valid country name.'],
            ["\t\r\n", "The value \"\t\r\n\" is not a valid country name."],
        ];
    }
}
