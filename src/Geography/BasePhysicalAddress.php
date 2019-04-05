<?php

declare(strict_types=1);

namespace Tfy\ValueObject\Geography;

/**
 * Represents the base structure for a physical address.
 */
abstract class BasePhysicalAddress implements PhysicalAddress
{
    /** @var \Tfy\ValueObject\Geography\Street */
    protected $street;
    /** @var \Tfy\ValueObject\Geography\District */
    protected $district;
    /** @var \Tfy\ValueObject\Geography\City */
    protected $city;
    /** @var \Tfy\ValueObject\Geography\Region */
    protected $region;
    /** @var \Tfy\ValueObject\Geography\Country */
    protected $county;

    public function __construct(
        Street $street,
        District $district,
        City $city,
        Region $region,
        Country $county
    ) {
        $this->street   = $street;
        $this->district = $district;
        $this->city     = $city;
        $this->region   = $region;
        $this->county   = $county;
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

    public function getCounty() : ?Country
    {
        return $this->county;
    }
}
