<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography\Address\Physical\Country\Br;

use Talentify\ValueObject\Geography\Address\City;
use Talentify\ValueObject\Geography\Address\Country;
use Talentify\ValueObject\Geography\Address\Country\Br\Municipality;
use Talentify\ValueObject\Geography\Address\Country\Br\Neighbourhood as BrNeighbourhood;
use Talentify\ValueObject\Geography\Address\Country\Br\CEP as BrPostalCode;
use Talentify\ValueObject\Geography\Address\Country\Br\State as BrState;
use Talentify\ValueObject\Geography\Address\Country\Br\Street as BrStreet;
use Talentify\ValueObject\Geography\Address\Physical\PhysicalAddress;
use Talentify\ValueObject\Geography\Address\PostalCode;
use Talentify\ValueObject\Geography\Address\Region;
use Talentify\ValueObject\Geography\Address\Street as BaseStreet;
use Talentify\ValueObject\Geography\CountryList;
use Talentify\ValueObject\StringUtils;
use Talentify\ValueObject\ValueObject;

/**
 * Represents an address on Brazil (BRA).
 *
 * @see https://en.wikipedia.org/wiki/Address#Brazil
 */
final class BrPhysicalAddress implements PhysicalAddress
{
    /** @var \Talentify\ValueObject\Geography\Address\Country\Br\Street|null */
    private $street;
    /** @var \Talentify\ValueObject\Geography\Address\Country\Br\Neighbourhood|null */
    private $neighbourhood;
    /** @var \Talentify\ValueObject\Geography\Address\Country\Br\Municipality|null */
    private $municipality;
    /** @var \Talentify\ValueObject\Geography\Address\Country\Br\State|null */
    private $state;
    /** @var \Talentify\ValueObject\Geography\Address\Country\Br\CEP|null */
    private $postalCode;
    /** @var \Talentify\ValueObject\Geography\Address\Country */
    private $country;
    /** @var string */
    private $formattedAddress;

    public function __construct(
        ?BrStreet $street = null,
        ?BrNeighbourhood $neighbourhood = null,
        ?Municipality $municipality = null,
        ?BrState $state = null,
        ?BrPostalCode $postalCode = null,
        ?string $formattedAddress = null
    ) {
        $this->street           = $street;
        $this->neighbourhood    = $neighbourhood;
        $this->municipality     = $municipality;
        $this->state            = $state;
        $this->postalCode       = $postalCode;
        $this->country          = CountryList::BR();
        $this->formattedAddress = $formattedAddress;
    }

    /**
     * @return \Talentify\ValueObject\Geography\Address\Country\Br\Street
     */
    public function getStreet() : ?BaseStreet
    {
        return $this->street;
    }

    public function getNeighbourhood() : ?BrNeighbourhood
    {
        return $this->neighbourhood;
    }

    public function getMunicipality() : ?Municipality
    {
        return $this->municipality;
    }

    /**
     * @return \Talentify\ValueObject\Geography\Address\Country\Br\Municipality|null
     */
    public function getCity() : ?City
    {
        return $this->municipality;
    }

    /**
     * @return \Talentify\ValueObject\Geography\Address\Country\Br\State|null
     */
    public function getRegion() : ?Region
    {
        return $this->state;
    }

    /**
     * @return \Talentify\ValueObject\Geography\Address\Country\Br\State|null
     */
    public function getState() : ?BrState
    {
        return $this->state;
    }

    /**
     * @return \Talentify\ValueObject\Geography\Address\Country\Br\CEP|null
     */
    public function getPostalCode() : ?PostalCode
    {
        return $this->postalCode;
    }

    /**
     * @return \Talentify\ValueObject\Geography\Address\Country\Br\CEP|null
     */
    public function getCep() : ? BrPostalCode
    {
        return $this->postalCode;
    }

    public function getCountry() : Country
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
                (null === $this->getStreet() && null === $object->getStreet()) ||
                $this->getStreet()->equals($object->getStreet())
            ) &&
            (
                (null === $this->getMunicipality() && null === $object->getMunicipality()) ||
                $this->getMunicipality()->equals($object->getMunicipality())
            ) &&
            (
                (null === $this->getState() && null === $object->getState()) ||
                $this->getState()->equals($object->getState())
            ) &&
            (
                (null === $this->getCep() && null === $object->getCep()) ||
                $this->getCep()->equals($object->getCep())
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

        $street       = $this->getStreet() ? $this->getStreet()->getFormatted() : '';
        $municipality = $this->getMunicipality() ? $this->getMunicipality()->getFormatted() : '';
        $state        = $this->getState() ? $this->getState()->getFormatted() : '';
        $postalCode   = $this->getPostalCode() ? $this->getPostalCode()->getFormatted() : '';
        $country      = $this->getCountry() ? $this->getCountry()->getFormatted() : '';

        $formatted = sprintf(
            '%s. %s, %s, %s %s', $street, $municipality, $state, $postalCode, $country
        );

        return StringUtils::trimSpacesWisely($formatted);
    }

    public function __toString() : string
    {
        return $this->getFormattedAddress();
    }
}
