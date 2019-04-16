<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography;

class CountryList
{
    public static function EUA() : Country
    {
        return new Country('United States Of America', 'US', 'USA');
    }
}
