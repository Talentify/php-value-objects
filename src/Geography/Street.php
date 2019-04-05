<?php

declare(strict_types=1);

namespace Tfy\ValueObject\Geography;

use Tfy\ValueObject\ValueObject;

/**
 * @see https://en.wikipedia.org/wiki/Street_or_road_name
 */
class Street implements ValueObject
{
    /** @var string */
    protected $name;
    /** @var string */
    protected $number;
    /** @var string other identifiers such as house or apartment numbers */
    protected $otherIdentifiers;

    /**
     * @throws \InvalidArgumentException if supplied value is invalid.
     */
    public function __construct(string $name, string $number, string $otherIdentifiers)
    {
        $this->name             = $name;
        $this->number           = $number;
        $this->otherIdentifiers = $otherIdentifiers;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getNumber() : string
    {
        return $this->number;
    }

    public function getOtherIdentifiers() : string
    {
        return $this->otherIdentifiers;
    }

    public function equals(ValueObject $object) : bool
    {
        if (!$object instanceof self) {
            return false;
        }

        return $object->getName() === $this->getName() &&
            $object->getNumber() === $this->getNumber() &&
            $object->getOtherIdentifiers() === $this->getOtherIdentifiers();
    }

    public function __toString() : string
    {
        return $this->name;
    }
}
