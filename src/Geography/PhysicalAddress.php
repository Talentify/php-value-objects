<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography;

/**
 * A physical address in only the location i.e. the address without name and company name.
 * @see https://en.wikipedia.org/wiki/Address#Address_format
 */
interface PhysicalAddress
{
    public function getStreet() : ?Street;

    public function getDistrict() : ?District;

    public function getCity() : ?City;

    public function getRegion() : ?Region;

    public function getCounty() : ?Country;
}
