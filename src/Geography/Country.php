<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography;

use Talentify\ValueObject\StringUtils;
use Talentify\ValueObject\ValueObject;

class Country implements ValueObject
{
    /** @var string */
    private $name;
    /** @var string */
    private $isoAlpha2;
    /** @var string */
    private $isoAlpha3;

    /**
     * @throws \InvalidArgumentException if supplied value is invalid.
     * @see https://en.wikipedia.org/wiki/ISO_3166-1
     */
    public function __construct(
        string $name,
        string $isoAlpha2,
        string $isoAlpha3
    ) {
        $this->setName($name);
        $this->setIsoAlpha2($isoAlpha2);
        $this->setIsoAlpha3($isoAlpha3);
    }

    private function setName(string $name) : void
    {
        $normalized = StringUtils::trimSpaces($name);
        if (empty($normalized)) {
            throw new \InvalidArgumentException(sprintf('The value "%s" is not a valid country name.', $name));
        }

        $this->name = StringUtils::convertCaseToTitle($normalized);
    }

    public function getName() : string
    {
        return $this->name;
    }

    private function setIsoAlpha2(string $value) : void
    {
        $normalized = StringUtils::trimSpaces($value);
        if (empty($normalized) || \strlen($normalized) !== 2) {
            throw new \InvalidArgumentException(sprintf('The value "%s" is not a valid ISO 3166-1 alpha 2.', $value));
        }

        $this->isoAlpha2 = mb_convert_case($value, MB_CASE_UPPER, 'UTF-8');
    }

    /**
     * Returns the alpha-2 code for the ISO 3166-1.
     *
     * @see https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2
     */
    public function getIsoAlpha2() : string
    {
        return $this->isoAlpha2;
    }

    private function setIsoAlpha3(string $value) : void
    {
        $normalized = StringUtils::trimSpaces($value);
        if (empty($normalized) || \strlen($normalized) !== 3) {
            throw new \InvalidArgumentException(sprintf('The value "%s" is not a valid ISO 3166-1 alpha 3.', $value));
        }

        $this->isoAlpha3 = mb_convert_case($value, MB_CASE_UPPER, 'UTF-8');
    }

    /**
     * Returns the alpha-3 code for the ISO 3166-1.
     *
     * @see https://en.wikipedia.org/wiki/ISO_3166-1_alpha-3
     */
    public function getIsoAlpha3() : string
    {
        return $this->isoAlpha3;
    }

    public function equals(ValueObject $object) : bool
    {
        if (! $object instanceof self) {
            return false;
        }

        return $object->getIsoAlpha2() === $this->getIsoAlpha2() &&
            $object->getIsoAlpha3() === $this->getIsoAlpha3();
    }

    public function __toString() : string
    {
        return $this->name;
    }
}
