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
use function count;
use function is_object;

/**
 * A confuse physical address.
 *
 * Example:
 * - new MessyPhysicalAddress('400 Broad St, Seattle')
 * - new MessyPhysicalAddress('400 Broad St', new City('Seattle'), new Region('Washington', 'WA'), CountryList::US())
 */
class MessyPhysicalAddress implements PhysicalAddress
{
    /** @var string */
    private $messyAddress;
    /** @var \Talentify\ValueObject\Geography\Address\City|null */
    private $city;
    /** @var \Talentify\ValueObject\Geography\Address\Region|null */
    private $region;
    /** @var \Talentify\ValueObject\Geography\Address\Country|null */
    private $country;
    /** @var string */
    private $formattedAddress;

    /**
     * @throws \InvalidArgumentException
     */
    public function __construct(
        string $messyAddress,
        ?City $city = null,
        ?Region $region = null,
        ?Country $country = null
    ) {
        $this->city    = $city;
        $this->region  = $region;
        $this->country = $country;
        $this->setMessyAddress($messyAddress);
        $this->setFormattedAddress();
    }

    protected function setMessyAddress(string $messyAddress) : void
    {
        $normalized = StringUtils::trimSpacesWisely($messyAddress);
        if ($normalized === null || $normalized === '') {
            throw new InvalidArgumentException(sprintf('The given value "%s" is an empty string.', $messyAddress));
        }

        $this->messyAddress = StringUtils::convertCaseToTitle($normalized);
    }

    protected function setFormattedAddress() : void
    {
        $notNull = array_filter([$this->city, $this->region, $this->country], function ($element) {
            return $element !== null;
        });

        if (count($notNull) === 0) {
            $this->formattedAddress = $this->messyAddress;
            return;
        }

        $secondSegment = implode(', ', $notNull);
        if (stripos($this->messyAddress, $secondSegment) !== false) {
            $this->formattedAddress = $this->messyAddress;
            return;
        }

        $this->formattedAddress = sprintf('%s, %s', $this->messyAddress, $secondSegment);
    }

    public function getMessyAddress() : string
    {
        return $this->messyAddress;
    }

    /**
     * {@inheritDoc}
     */
    public function getStreet() : ?Street
    {
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function getCity() : ?City
    {
        return $this->city;
    }

    /**
     * {@inheritDoc}
     */
    public function getRegion() : ?Region
    {
        return $this->region;
    }

    /**
     * {@inheritDoc}
     */
    public function getPostalCode() : ?PostalCode
    {
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function getCountry() : ?Country
    {
        return $this->country;
    }

    /**
     * {@inheritDoc}
     */
    public function getAddress() : string
    {
        return $this->formattedAddress;
    }

    /**
     * {@inheritDoc}
     */
    public function equals(?ValueObject $object) : bool
    {
        if (!$object instanceof self) {
            return false;
        }

        return (
            (
                strtolower($this->getMessyAddress()) === strtolower($object->getMessyAddress())
            ) &&
            (
                (null === $this->getCity() && null === $object->getCity()) ||
                (is_object($this->getCity()) && $this->getCity()->equals($object->getCity())) ||
                (is_object($object->getCity()) && $object->getCity()->equals($this->getCity()))
            ) &&
            (
                (null === $this->getRegion() && null === $object->getRegion()) ||
                (is_object($this->getRegion()) && $this->getRegion()->equals($object->getRegion())) ||
                (is_object($object->getRegion()) && $object->getRegion()->equals($this->getRegion()))
            ) &&
            (
                (null === $this->getCountry() && null === $object->getCountry()) ||
                (is_object($this->getCountry()) && $this->getCountry()->equals($object->getCountry())) ||
                (is_object($object->getCountry()) && $object->getCountry()->equals($this->getCountry()))
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function __toString() : string
    {
        return $this->getAddress();
    }
}
