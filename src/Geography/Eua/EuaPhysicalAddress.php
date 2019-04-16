<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography\Eua;

use Talentify\ValueObject\Geography\BasePhysicalAddress;
use Talentify\ValueObject\Geography\City;
use Talentify\ValueObject\Geography\Country;
use Talentify\ValueObject\Geography\CountryList;
use Talentify\ValueObject\Geography\District;
use Talentify\ValueObject\Geography\PhysicalAddress;
use Talentify\ValueObject\Geography\Region;
use Talentify\ValueObject\Geography\Street;

/**
 * Represents an address on the United States of America (USA).
 *
 * @see https://en.wikipedia.org/wiki/Address#United_States
 */
class EuaPhysicalAddress implements PhysicalAddress
{
    /** @var \Talentify\ValueObject\Geography\Street */
    protected $street;
    /** @var \Talentify\ValueObject\Geography\District */
    protected $district;
    /** @var \Talentify\ValueObject\Geography\City */
    protected $city;
    /** @var \Talentify\ValueObject\Geography\Region */
    protected $region;
    /** @var \Talentify\ValueObject\Geography\Country */
    protected $country;
    /** @var string */
    protected $address;

    public function __construct(
        Street $street,
        City $city, // Town
        Region $region, // State
        ZipCode $zipCode
    ) {
        $this->street   = $street;
        $this->city     = $city;
        $this->region   = $region;
        $this->country  = CountryList::EUA();
        $this->address  = ''; // #TODO
    }

    public function getStreet() : ?Street
    {
        return $this->street;
    }

    public function getDistrict() : ?District
    {
        return $this->district;
    }

    public function getCity() : ?City
    {
        return $this->city;
    }

    public function getTown() : ?City
    {
        return $this->city;
    }

    public function getRegion() : ?Region
    {
        return $this->region;
    }

    public function getState() : ?Region
    {
        return $this->region;
    }

    public function getCountry() : ?Country
    {
        return $this->country;
    }

    public function getAddress() : string
    {
        return $this->address;
    }

    public function __toString()
    {
        return $this->address;
    }
}
