<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography\Address;

use InvalidArgumentException;
use Talentify\ValueObject\StringUtils;
use Talentify\ValueObject\ValueObject;
use function strlen;

class Country implements AddressElement
{
    /** @var string */
    private $name;
    /** @var string|null */
    private $isoAlpha2;
    /** @var string|null */
    private $isoAlpha3;

    /**
     * @param string|null $isoAlpha2 https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2
     * @param string|null $isoAlpha3 https://en.wikipedia.org/wiki/ISO_3166-1_alpha-3
     *
     * @throws \InvalidArgumentException if supplied value is invalid.
     *
     * @see https://en.wikipedia.org/wiki/ISO_3166-1
     */
    public function __construct(
        string $name,
        ?string $isoAlpha2 = null,
        ?string $isoAlpha3 = null
    ) {
        $this->setName($name);
        $this->setIsoAlpha2($isoAlpha2);
        $this->setIsoAlpha3($isoAlpha3);
    }

    private function setName(string $name) : void
    {
        $normalized = StringUtils::trimSpacesWisely($name);
        if (empty($normalized)) {
            throw new InvalidArgumentException(sprintf('The value "%s" is not a valid country name.', $name));
        }

        if (strlen($normalized) === 2) {
            $this->setIsoAlpha2($normalized);
        }

        if (strlen($normalized) === 3) {
            $this->setIsoAlpha3($normalized);
        }

        $this->name = StringUtils::convertCaseToTitle($normalized);
    }

    public function getName() : string
    {
        return $this->name;
    }

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

    private function setIsoAlpha3(?string $value = null) : void
    {
        if ($value === null) {
            return;
        }

        $normalized = StringUtils::removeSpaces($value);
        if (empty($normalized) || strlen($normalized) !== 3) {
            throw new InvalidArgumentException(
                sprintf('The value "%s" (%s) is not a valid ISO 3166-1 alpha 3.', $value, $normalized)
            );
        }

        $this->isoAlpha3 = StringUtils::convertCaseToUpper($normalized);
    }

    /**
     * Returns the alpha-3 code for the ISO 3166-1.
     *
     * @see https://en.wikipedia.org/wiki/ISO_3166-1_alpha-3
     */
    public function getIsoAlpha3() : ?string
    {
        return $this->isoAlpha3;
    }

    public function equals(?ValueObject $object) : bool
    {
        if (!$object instanceof self) {
            return false;
        }

        return $object->getName() === $this->getName() &&
            $object->getIsoAlpha2() === $this->getIsoAlpha2() &&
            $object->getIsoAlpha3() === $this->getIsoAlpha3();
    }

    public function getFormatted() : string
    {
        return sprintf('%s %s', $this->getName(), $this->getIsoAlpha2());
    }

    public function __toString() : string
    {
        if ($this->isoAlpha2 !== null) {
            return $this->isoAlpha2;
        }

        if ($this->isoAlpha3 !== null) {
            return $this->isoAlpha3;
        }
        return $this->name;
    }
}
