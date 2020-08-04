<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography\Address;

use InvalidArgumentException;
use Talentify\ValueObject\StringUtils;
use Talentify\ValueObject\ValueObject;

/**
 * An area that are broadly divided by human impact characteristics such as
 * provinces, states, counties, townships, territories, etc.
 *
 * @see https://en.wikipedia.org/wiki/Region#Political_regions
 * @see https://en.wikipedia.org/wiki/ISO_3166-2
 */
class Region implements AddressElement
{
    /** @var string */
    private $name;
    /** @var string|null */
    private $isoAlpha2;

    /**
     * @param string|null $isoAlpha2 https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2
     *
     * @throws \InvalidArgumentException if supplied value is invalid.
     */
    public function __construct(string $name, ?string $isoAlpha2 = null)
    {
        $this->setName($name);
        $this->setIsoAlpha2($isoAlpha2);
    }

    private function setName(string $name) : void
    {
        $normalized = StringUtils::trimSpacesWisely($name);
        if (empty($normalized)) {
            throw new \InvalidArgumentException(sprintf('The value "%s" is not a valid region name.', $name));
        }

        $this->name = StringUtils::convertCaseToTitle($normalized);
    }

    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @throws \InvalidArgumentException
     */
    private function setIsoAlpha2(?string $value) : void
    {
        if ($value === null) {
            return;
        }

        $normalized = StringUtils::removeSpaces($value);
        if (empty($normalized) || strlen($normalized) !== 2) {
            throw new InvalidArgumentException(
                sprintf('The value "%s" (%s) is not a valid ISO 3166-1 alpha 2.', $value, $normalized)
            );
        }

        $this->isoAlpha2 = StringUtils::convertCaseToUpper($normalized);
    }

    /**
     * Returns the alpha-2 code for the ISO 3166-1.
     *
     * @see https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2
     */
    public function getIsoAlpha2() : ?string
    {
        return $this->isoAlpha2;
    }

    public function equals(?ValueObject $object) : bool
    {
        if (!$object instanceof self) {
            return false;
        }

        return $object->getName() === $this->getName() &&
            $object->getIsoAlpha2() === $this->getIsoAlpha2();
    }

    public function getFormatted() : string
    {
        return sprintf('%s %s', $this->getName(), $this->getIsoAlpha2());
    }

    public function __toString() : string
    {
        if ($this->isoAlpha2 !== null) {
            return strtoupper($this->isoAlpha2);
        }

        return $this->name;
    }
}
