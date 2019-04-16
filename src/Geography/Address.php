<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography;

interface Address
{
    /**
     * Returns the formatted address.
     */
    public function getAddress() : string;

    /**
     * Returns the formatted address.
     */
    public function __toString();
}
