<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography\Address\Physical;

use Talentify\ValueObject\Geography\Address\City;
use Talentify\ValueObject\Geography\Address\Country;
use Talentify\ValueObject\Geography\Address\PostalCode;
use Talentify\ValueObject\Geography\Address\Region;
use Talentify\ValueObject\Geography\Address\Street;
use Talentify\ValueObject\StringUtils;
use Talentify\ValueObject\ValueObject;

/**
 * A generic structure for a physical address.
 */
class GenericPhysicalAddress implements PhysicalAddress
{
    /** @var \Talentify\ValueObject\Geography\Address\Street|null */
    protected $street;
    /** @var \Talentify\ValueObject\Geography\Address\City|null */
    protected $city;
    /** @var \Talentify\ValueObject\Geography\Address\Region|null */
    protected $region;
    /** @var \Talentify\ValueObject\Geography\Address\PostalCode|null */
    protected $postalCode;
    /** @var \Talentify\ValueObject\Geography\Address\Country|null */
    protected $country;
    /** @var string */
    protected $formattedAddress;

    /**
     * @throws \InvalidArgumentException
     */
    public function __construct(
        ?Street $street = null,
        ?City $city = null,
        ?Region $region = null,
        ?PostalCode $postalCode = null,
        ?Country $country = null,
        ?string $formattedAddress = null
    ) {
        $this->street           = $street;
        $this->city             = $city;
        $this->region           = $region;
        $this->postalCode       = $postalCode;
        $this->country          = $country;
        $this->formattedAddress = $formattedAddress;
    }

    public function getStreet() : ?Street
    {
        return $this->street;
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

    public function getPostalCode() : ?PostalCode
    {
        return $this->postalCode;
    }

    public function equals(?ValueObject $object) : bool
    {
        if (!$object instanceof self) {
            return false;
        }

        return (
            (
                (null === $this->getStreet() && null === $object->getStreet()) ||
                (\is_object($this->getStreet()) && $this->getStreet()->equals($object->getStreet())) ||
                (\is_object($object->getStreet()) && $object->getStreet()->equals($this->getStreet()))
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
                (null === $this->getPostalCode() && null === $object->getPostalCode()) ||
                (\is_object($this->getPostalCode()) && $this->getPostalCode()->equals($object->getPostalCode())) ||
                (\is_object($object->getPostalCode()) && $object->getPostalCode()->equals($this->getPostalCode()))
            ) &&
            (
                (null === $this->getCountry() && null === $object->getCountry()) ||
                (\is_object($this->getCountry()) && $this->getCountry()->equals($object->getCountry())) ||
                (\is_object($object->getCountry()) && $object->getCountry()->equals($this->getCountry()))
            )
        );
    }

    public function getAddress() : string
    {
        if ($this->formattedAddress !== null) {
            return $this->formattedAddress;
        }

        $street     = $this->getStreet() ? $this->getStreet()->getFormatted() : '';
        $city       = $this->getCity() ? $this->getCity()->getFormatted() : '';
        $region     = $this->getRegion() ? $this->getRegion()->getFormatted() : '';
        $postalCode = $this->getPostalCode() ? $this->getPostalCode()->getFormatted() : '';
        $country    = $this->getCountry() ? $this->getCountry()->getFormatted() : '';

        $formatted = sprintf(
            '%s, %s, %s, %s %s', $street, $city, $region, $postalCode, $country
        );

        return StringUtils::trimSpacesWisely($formatted);
    }

    public function __toString() : string
    {
        return $this->getAddress();
    }
}
