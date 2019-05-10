<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography\Address;

use InvalidArgumentException;
use Talentify\ValueObject\StringUtils;
use Talentify\ValueObject\ValueObject;

/**
 * @see https://en.wikipedia.org/wiki/Street_or_road_name
 */
class Street implements AddressElement
{
    /** @var string */
    protected $name;
    /** @var string */
    protected $number;
    /** @var string|null other identifiers such as house or apartment numbers */
    protected $otherIdentifiers;

    /**
     * @throws \InvalidArgumentException if supplied value is invalid.
     */
    public function __construct(string $name, ?string $number = null, ?string $otherIdentifiers = null)
    {
        $this->setName($name);
        $this->setNumber($number);
        $this->setOthers($otherIdentifiers);
    }

    protected function setName(string $name) : void
    {
        $normalized = StringUtils::trimSpacesWisely($name);
        if (empty($normalized)) {
            throw new InvalidArgumentException(sprintf('The value "%s" is not a valid street name.', $name));
        }

        $this->name = StringUtils::convertCaseToTitle($normalized);
    }

    public function getName() : string
    {
        return $this->name;
    }

    protected function setNumber(?string $number = null) : void
    {
        if ($number === null) {
            return;
        }

        $normalized = StringUtils::trimSpacesWisely($number);
        if (empty($normalized)) {
            throw new InvalidArgumentException(sprintf('The value "%s" is not a valid "number".', $number));
        }

        $this->number = $number;
    }

    public function getNumber() : ?string
    {
        return $this->number;
    }

    protected function setOthers(?string $others = null) : void
    {
        if ($others === null) {
            return;
        }

        $normalized = StringUtils::trimSpacesWisely($others);
        if (empty($normalized)) {
            throw new InvalidArgumentException(sprintf('The value "%s" is not a valid "other identifiers".', $others));
        }

        $this->otherIdentifiers = $normalized;
    }

    public function getOtherIdentifiers() : ?string
    {
        return $this->otherIdentifiers;
    }

    public function equals(?ValueObject $object) : bool
    {
        if (!$object instanceof self) {
            return false;
        }

        return strtolower($object->getName()) === strtolower($this->getName()) &&
            strtolower($object->getNumber()) === strtolower($this->getNumber()) &&
            strtolower($object->getOtherIdentifiers()) === strtolower($this->getOtherIdentifiers());
    }

    public function getFormatted() : string
    {
        return sprintf('%s %s, %s', $this->getName(), $this->getNumber(), $this->getOtherIdentifiers());
    }

    public function __toString() : string
    {
        return $this->name;
    }
}
