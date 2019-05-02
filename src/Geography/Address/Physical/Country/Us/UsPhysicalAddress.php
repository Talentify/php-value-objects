<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography\Address\Physical\Country\Us;

use Talentify\ValueObject\Geography\Address\City;
use Talentify\ValueObject\Geography\Address\City as BaseCity;
use Talentify\ValueObject\Geography\Address\Country;
use Talentify\ValueObject\Geography\Address\Country\Us\State;
use Talentify\ValueObject\Geography\Address\Country\Us\ZipCode;
use Talentify\ValueObject\Geography\Address\District as BaseDistrict;
use Talentify\ValueObject\Geography\Address\Physical\PhysicalAddress;
use Talentify\ValueObject\Geography\Address\PostalCode;
use Talentify\ValueObject\Geography\Address\Region;
use Talentify\ValueObject\Geography\Address\Street;
use Talentify\ValueObject\Geography\Address\Street as BaseStreet;
use Talentify\ValueObject\Geography\CountryList;
use Talentify\ValueObject\StringUtils;
use Talentify\ValueObject\ValueObject;

/**
 * Represents an address on the United States of America (USA).
 *
 * @see https://en.wikipedia.org/wiki/Address#United_States
 */
final class UsPhysicalAddress implements PhysicalAddress
{
    /** @var \Talentify\ValueObject\Geography\Address\Street|null */
    private $street;
    /** @var \Talentify\ValueObject\Geography\Address\City|null */
    private $city;
    /** @var \Talentify\ValueObject\Geography\Address\Country\Us\State|null */
    private $state;
    /** @var \Talentify\ValueObject\Geography\Address\Country\Us\ZipCode|null */
    private $zipCode;
    /** @var \Talentify\ValueObject\Geography\Address\Country */
    private $country;
    /** @var string */
    private $formattedAddress;

    public function __construct(
        ?BaseStreet $street = null,
        ?BaseCity $town = null,
        ?State $state = null,
        ?ZipCode $zipCode = null,
        ?string $formattedAddress = null
    ) {
        $this->street           = $street;
        $this->city             = $town;
        $this->state            = $state;
        $this->zipCode  = $zipCode;
        $this->country          = CountryList::US();
        $this->formattedAddress = $formattedAddress;
    }

    public function getStreet() : ?Street
    {
        return $this->street;
    }

    public function getDistrict() : ?BaseDistrict
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
        return $this->state;
    }

    public function getState() : ?Region
    {
        return $this->state;
    }

    public function getCountry() : Country
    {
        return $this->country;
    }

    public function getPostalCode() : ?PostalCode
    {
        return $this->zipCode;
    }

    public function getZipCode() :? ZipCode
    {
        return $this->zipCode;
    }

    public function equals(?ValueObject $object) : bool
    {
        if (!$object instanceof self) {
            return false;
        }

        return (
            (
                (null === $this->getStreet() && null === $object->getStreet()) ||
                $this->getStreet()->equals($object->getStreet())
            ) &&
            (
                (null === $this->getCity() && null === $object->getCity()) ||
                $this->getCity()->equals($object->getCity())
            ) &&
            (
                (null === $this->getState() && null === $object->getState()) ||
                $this->getState()->equals($object->getState())
            ) &&
            (
                (null === $this->getZipCode() && null === $object->getZipCode()) ||
                $this->getZipCode()->equals($object->getZipCode())
            ) &&
            (
                (null === $this->getCountry() && null === $object->getCountry()) ||
                $this->getCountry()->equals($object->getCountry())
            )
        );
    }

    public function getFormattedAddress() : string
    {
        if ($this->formattedAddress !== null) {
            return $this->formattedAddress;
        }

        $street     = $this->getStreet() ? $this->getStreet()->getFormatted() : '';
        $city       = $this->getCity() ? $this->getCity()->getFormatted() : '';
        $state      = $this->getState() ? $this->getState()->getFormatted() : '';
        $postalCode = $this->getPostalCode() ? $this->getPostalCode()->getFormatted() : '';
        $country    = $this->getCountry() ? $this->getCountry()->getFormatted() : '';

        $formatted = sprintf(
            '%s, %s, %s, %s %s', $street, $city, $state, $postalCode, $country
        );

        return StringUtils::trimSpacesWisely($formatted);
    }

    public function __toString() : string
    {
        return $this->getFormattedAddress();
    }
}
