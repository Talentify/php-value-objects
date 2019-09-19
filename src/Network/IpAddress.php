<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Network;

use Talentify\ValueObject\ValueObject;

class IpAddress implements ValueObject
{
    /** @var string */
    private $ipAddress;

    /**
     * @throws \InvalidArgumentException if IP address is not valid
     */
    public function __construct(string $ipAddress)
    {
        if (filter_var($ipAddress, FILTER_VALIDATE_IP) === false) {
            throw new \InvalidArgumentException(sprintf('The value %s is not a valid IP address.', $ipAddress));
        }

        $this->ipAddress = $ipAddress;
    }

    public function getIpAddress() : string
    {
        return $this->ipAddress;
    }

    public function equals(?ValueObject $object) : bool
    {
        if (!$object instanceof self) {
            return false;
        }

        return $object->getIpAddress() === $this->getIpAddress();
    }

    public function __toString() : string
    {
        return $this->ipAddress;
    }
}
