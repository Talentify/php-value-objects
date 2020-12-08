<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography;

use Talentify\ValueObject\Geography\Address\Country;

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

    public static function ES() : Country
    {
        return new Country('Spain', 'ES', 'ESP');
    }

    public static function FR() : Country
    {
        return new Country('France', 'FR', 'FRA');
    }
}
