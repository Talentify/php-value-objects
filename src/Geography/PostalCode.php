<?php

declare(strict_types=1);

namespace Tfy\ValueObject\Geography;

use Tfy\ValueObject\StringUtils;
use Tfy\ValueObject\ValueObject;

/**
 * @see https://en.wikipedia.org/wiki/Address#Postal_codes
 */
class PostalCode implements ValueObject
{
    /** @var string */
    private $value;

    public function __construct(string $value)
    {
        $this->setValue($value);
    }

    private function setValue(string $value) : void
    {
        $normalized = StringUtils::trimSpaces($value);
        if (empty($normalized)) {
            throw new \InvalidArgumentException(sprintf('The value "%s" is not a valid postal code.', $value));
        }

        $this->value = $normalized;
    }

    public function getValue() : string
    {
        return $this->value;
    }

    public function equals(ValueObject $object) : bool
    {
        if (! $object instanceof self) {
            return false;
        }

        return $object->getValue() === $this->getValue();
    }

    public function __toString() : string
    {
        return $this->value;
    }
}
