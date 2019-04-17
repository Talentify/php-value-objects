<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography;

/**
 * @see https://en.wikipedia.org/wiki/ISO_3166-1#Current_codes
 */
class CountryList
{
    public static function BR() : Country
    {
        return new Country('Brazil', 'BR', 'BRA');
    }

    public static function US() : Country
    {
        return new Country('United States Of America', 'US', 'USA');
    }
}
