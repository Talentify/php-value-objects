<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography\Address;

use JsonSerializable;
use Talentify\ValueObject\ValueObject;

interface AddressElement extends ValueObject, JsonSerializable
{
    public function getFormatted() : string;
}
