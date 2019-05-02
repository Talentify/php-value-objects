<?php

declare(strict_types=1);

namespace Talentify\ValueObject;

/**
 * Describe the minimum requirements to any Value Object.
 */
interface ValueObject
{
    /**
     * Whether or not the current object is equal to the other.
     */
    public function equals(?ValueObject $object) : bool;

    /**
     * Return the Value Object's string representation.
     */
    public function __toString() : string;
}
