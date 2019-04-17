<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography;

use Talentify\ValueObject\ValueObject;

interface Address extends ValueObject
{
    /**
     * Returns the formatted address.
     */
    public function getAddress() : string;

    /**
     * Returns the formatted address.
     */
    public function __toString() : string;
}
