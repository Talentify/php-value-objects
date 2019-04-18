<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography\Us;

use Talentify\ValueObject\Geography\City;
use Talentify\ValueObject\Geography\Country;
use Talentify\ValueObject\Geography\CountryList;
use Talentify\ValueObject\Geography\District;
use Talentify\ValueObject\Geography\PhysicalAddress;
use Talentify\ValueObject\Geography\Region;
use Talentify\ValueObject\Geography\Street;
use Talentify\ValueObject\ValueObject;

/**
 * Represents an address on the United States of America (USA).
 *
 * @see https://en.wikipedia.org/wiki/Address#United_States
 */
final class UsPhysicalAddress implements PhysicalAddress
{
    /** @var \Talentify\ValueObject\Geography\Street */
    protected $street;
    /** @var \Talentify\ValueObject\Geography\City */
    protected $city;
    /** @var \Talentify\ValueObject\Geography\Region */
    protected $region;
    /** @var \Talentify\ValueObject\Geography\Country */
    protected $country;
    /** @var string */
    protected $address;

    public function __construct(
        ?Street $street = null,
        ?City $town = null,
        ?Region $state = null,
        ?ZipCode $zipCode = null
    ) {
        $this->street  = $street;
        $this->city    = $town;
        $this->region  = $state;
        $this->country = CountryList::US();
        $this->address = ''; // #TODO
    }

    public function getStreet() : ?Street
    {
        return $this->street;
    }

    public function getDistrict() : ?District
    {
        return null;
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

    public function getCountry() : Country
    {
        return $this->country;
    }

    public function getAddress() : string
    {
        return $this->address;
    }

    public function equals(ValueObject $object) : bool
    {
        if (!$object instanceof self) {
            return false;
        }

        $street  = $this->getStreet() ?: new Street('<empty>', '<empty>', '<empty>');
        $city    = $this->getCity() ?: new City('<empty>');
        $region  = $this->getRegion() ?: new Region('<empty>');
        $country = $this->getCountry() ?: new Country('<empty>');
        // #TODO zip code

        return $street->equals($object->getStreet()) &&
            $city->equals($object->getCity()) &&
            $region->equals($object->getRegion()) &&
            $country->equals($object->getCountry());
    }

    public function __toString() : string
    {
        return $this->address;
    }
}
