<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography\Address;

use Talentify\ValueObject\StringUtils;
use Talentify\ValueObject\ValueObject;

/**
 * @see https://en.wikipedia.org/wiki/Address#Postal_codes
 * @see https://en.wikipedia.org/wiki/Postal_code
 */
class PostalCode implements AddressElement
{
    /** @var string */
    private $value;

    /**
     * @throws \InvalidArgumentException
     */
    public function __construct(string $value)
    {
        $this->setValue($value);
    }

    protected function setValue(string $value) : void
    {
        $normalized = StringUtils::trimSpacesWisely($value);
        if (empty($normalized)) {
            throw new \InvalidArgumentException(sprintf('The value "%s" is not a valid postal code.', $value));
        }

        $this->value = $normalized;
    }

    public function getValue() : string
    {
        return $this->value;
    }

    public function equals(?ValueObject $object) : bool
    {
        if (!$object instanceof self) {
            return false;
        }

        return $object->getValue() === $this->getValue();
    }

    public function getFormatted() : string
    {
        return sprintf('%s', $this->getValue());
    }

    public function __toString() : string
    {
        return $this->value;
    }

    public function jsonSerialize() : mixed
    {
        return [
            'value' => $this->value,
        ];
    }
}
