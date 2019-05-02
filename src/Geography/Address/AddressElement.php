<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography\Address;

use Talentify\ValueObject\ValueObject;

interface AddressElement extends ValueObject
{
    public function getFormatted() : string;
}
