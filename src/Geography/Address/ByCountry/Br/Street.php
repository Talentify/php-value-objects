<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography\Address\ByCountry\Br;

use InvalidArgumentException;
use Talentify\ValueObject\Geography\Address\Street as B;
use Talentify\ValueObject\StringUtils;

class Street extends B
{
    /** @var string */
    private $type;

    /**
     * @throws \InvalidArgumentException if supplied value is invalid.
     */
    public function __construct(string $type, string $name, string $number, string $otherIdentifiers)
    {
        $this->setType($type);

        parent::__construct($name, $number, $otherIdentifiers);
    }

    protected function setType(string $type) : void
    {
        $normalized = StringUtils::trimSpacesWisely($type);
        if (empty($normalized)) {
            throw new InvalidArgumentException(sprintf('The value "%s" is not a valid brazilian street type.', $type));
        }

        $this->type = StringUtils::convertCaseToTitle($normalized);
    }

    public function getType() : string
    {
        return $this->type;
    }

    /**
     * e.g.: Avenida João Jorge, 112, ap. 31
     */
    public function getFormatted() : string
    {
        return sprintf(
            '%s %s, %s, %s',
            $this->getType(),
            $this->getName(),
            $this->getNumber(),
            $this->getOtherIdentifiers()
        );
    }
}
