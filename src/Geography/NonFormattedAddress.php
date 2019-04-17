<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography;

use InvalidArgumentException;
use Talentify\ValueObject\StringUtils;
use Talentify\ValueObject\ValueObject;

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
        $normalized = StringUtils::trimSpacesWisely($address);
        if (empty($normalized)) {
            throw new InvalidArgumentException(sprintf('The value "%s" is invalid.', $address));
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

    public function equals(ValueObject $object) : bool
    {
        if (!$object instanceof self) {
            return false;
        }

        return $this->getAddress() === $object->getAddress();
    }

    public function __toString() : string
    {
        return $this->getAddress();
    }
}
