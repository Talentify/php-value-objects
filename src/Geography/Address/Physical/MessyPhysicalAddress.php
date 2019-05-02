<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography\Address\Physical;

use InvalidArgumentException;
use Talentify\ValueObject\Geography\Address\City;
use Talentify\ValueObject\Geography\Address\Country;
use Talentify\ValueObject\Geography\Address\PostalCode;
use Talentify\ValueObject\Geography\Address\Region;
use Talentify\ValueObject\Geography\Address\Street;
use Talentify\ValueObject\StringUtils;
use Talentify\ValueObject\ValueObject;

/**
 * A confuse physical address.
 */
class MessyPhysicalAddress implements PhysicalAddress
{
    /** @var string */
    public $address;

    /**
     * @throws \InvalidArgumentException
     */
    public function __construct(
        string $messyAddress
    ) {
        $this->setAddress($messyAddress);
    }

    protected function setAddress(string $address) : void
    {
        $normalized = StringUtils::trimSpacesWisely($address);
        if (empty($normalized)) {
            throw new InvalidArgumentException(sprintf('The value "%s" is invalid.', $address));
        }

        $this->address = StringUtils::convertCaseToTitle($normalized);
    }

    public function getFormattedAddress() : string
    {
        return $this->address;
    }

    public function getStreet() : ?Street
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

    public function getPostalCode() : ?PostalCode
    {
        return null;
    }

    public function getCountry() : ?Country
    {
        return null;
    }

    public function equals(?ValueObject $object) : bool
    {
        if (!$object instanceof self) {
            return false;
        }

        return $this->getFormattedAddress() === $object->getFormattedAddress();
    }

    public function __toString() : string
    {
        return $this->getFormattedAddress();
    }
}
