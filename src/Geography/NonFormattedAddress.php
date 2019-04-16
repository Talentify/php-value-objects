<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography;

use Talentify\ValueObject\StringUtils;

/**
 * A messy address.
 */
class NonFormattedAddress implements PhysicalAddress
{
    /** @var string */
    public $address;

    public function __construct(string $address)
    {
        $this->setAddress($address);
    }

    protected function setAddress(string $address) : void
    {
        $normalized = StringUtils::trimSpaces($address);
        if (empty($normalized)) {
            throw new \InvalidArgumentException(sprintf('The value "%s" is invalid.', $address));
        }

        $this->address = StringUtils::convertCaseToTitle($normalized);
    }

    public function getAddress() : string
    {
        return $this->address;
    }

    public function getStreet() : ?Street
    {
        return null;
    }

    public function getDistrict() : ?District
    {
        return null;
    }

    public function getCity() : ?City
    {
        return null;
    }

    public function getRegion() : ?Region
    {
        return null;
    }

    public function getCountry() : ?Country
    {
        return null;
    }

    public function __toString()
    {
        return $this->getAddress();
    }
}
