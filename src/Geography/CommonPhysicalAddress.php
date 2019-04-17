<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography;

use Talentify\ValueObject\ValueObject;

/**
 * Represents a common structure for a physical address.
 */
class CommonPhysicalAddress implements PhysicalAddress
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
        ?Street $street,
        ?District $district,
        ?City $city,
        ?Region $region,
        ?Country $country
    ) {
        $this->street   = $street;
        $this->district = $district;
        $this->city     = $city;
        $this->region   = $region;
        $this->country  = $country;
        $this->address  = ''; // #TODO;
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

    public function getRegion() : ?Region
    {
        return $this->region;
    }

    public function getCountry() : ?Country
    {
        return $this->country;
    }

    public function equals(ValueObject $object) : bool
    {
        if (!$object instanceof self) {
            return false;
        }

        $street   = $this->getStreet() ?: new Street('<empty>', '<empty>', '<empty>');
        $district = $this->getDistrict() ?: new District('<empty>');
        $city     = $this->getCity() ?: new City('<empty>');
        $region   = $this->getRegion() ?: new Region('<empty>');
        $country  = $this->getCountry() ?: new Country('<empty>');

        return $street->equals($object->getStreet()) &&
            $district->equals($object->getDistrict()) &&
            $city->equals($object->getCity()) &&
            $region->equals($object->getRegion()) &&
            $country->equals($object->getCountry());
    }

    public function getAddress() : string
    {
        return $this->address;
    }

    public function __toString() : string
    {
        return $this->address;
    }
}
