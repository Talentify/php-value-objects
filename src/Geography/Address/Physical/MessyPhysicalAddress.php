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
    private $messyAddress;
    private $city;
    private $region;
    private $country;

    /**
     * @throws \InvalidArgumentException
     */
    public function __construct(
        string $messyAddress,
        ?City $city = null,
        ?Region $region = null,
        ?Country $country = null
    ) {
        $this->setMessyAddress($messyAddress);
        $this->city    = $city;
        $this->region  = $region;
        $this->country = $country;
    }

    protected function setMessyAddress(string $messyAddress) : void
    {
        $normalized = StringUtils::trimSpacesWisely($messyAddress);
        if (empty($normalized)) {
            throw new InvalidArgumentException(sprintf('The value "%s" is invalid.', $messyAddress));
        }

        $this->messyAddress = StringUtils::convertCaseToTitle($normalized);
    }

    public function getFormattedAddress() : string
    {
        return $this->messyAddress;
    }

    public function getStreet() : ?Street
    {
        return null;
    }

    public function getCity() : ?City
    {
        return $this->city;
    }

    public function getRegion() : ?Region
    {
        return $this->region;
    }

    public function getPostalCode() : ?PostalCode
    {
        return null;
    }

    public function getCountry() : ?Country
    {
        return $this->country;
    }

    public function equals(?ValueObject $object) : bool
    {
        if (!$object instanceof self) {
            return false;
        }

        return (
            (
                strtolower($this->getFormattedAddress()) === strtolower($object->getFormattedAddress())
            ) &&
            (
                (null === $this->getCity() && null === $object->getCity()) ||
                (\is_object($this->getCity()) && $this->getCity()->equals($object->getCity())) ||
                (\is_object($object->getCity()) && $object->getCity()->equals($this->getCity()))
            ) &&
            (
                (null === $this->getRegion() && null === $object->getRegion()) ||
                (\is_object($this->getRegion()) && $this->getRegion()->equals($object->getRegion())) ||
                (\is_object($object->getRegion()) && $object->getRegion()->equals($this->getRegion()))
            ) &&
            (
                (null === $this->getCountry() && null === $object->getCountry()) ||
                (\is_object($this->getCountry()) && $this->getCountry()->equals($object->getCountry())) ||
                (\is_object($object->getCountry()) && $object->getCountry()->equals($this->getCountry()))
            )
        );
    }

    public function __toString() : string
    {
        return $this->getFormattedAddress();
    }
}
