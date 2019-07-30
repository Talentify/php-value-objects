<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Linguistics;

use InvalidArgumentException;
use JsonSerializable;
use Talentify\ValueObject\StringUtils;
use Talentify\ValueObject\ValueObject;

/**
 * @see https://en.wikipedia.org/wiki/ISO_639-1
 * @see https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes
 */
final class LanguageISO6391 implements JsonSerializable, ValueObject
{
    /** @var string */
    private $name;
    /** @var string */
    private $isoCode;

    /**
     * @param string|null $isoCode a representation of one of this codes: https://en.wikipedia.org/wiki/Language_code
     */
    public function __construct(string $name, ?string $isoCode = null)
    {
        $this->setName($name);
        $this->setIsoCode($isoCode);
    }

    public function setName(string $name) : void
    {
        $normalized = StringUtils::removeSpaces($name);
        if (empty($normalized) || strlen($normalized) < 2) {
            throw new InvalidArgumentException("The value '$name' is not a valid language name");
        }

        if (strlen($normalized) === 2) {
            $this->setIsoCode($normalized);
        }

        $this->name = StringUtils::convertCaseToTitle($normalized);
    }

    public function setIsoCode(?string $isoCode) : void
    {
        if ($isoCode === null) {
            return;
        }

        $normalized = StringUtils::removeSpaces($isoCode);
        if (empty($normalized) || strlen($normalized) !== 2) {
            throw new InvalidArgumentException("The value '$isoCode' is not a valid language iso-code");
        }

        $this->isoCode = StringUtils::convertCaseToLower($normalized);
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getIsoCode() : ?string
    {
        return $this->isoCode;
    }

    public function equals(?ValueObject $object) : bool
    {
        if (!$object instanceof self) {
            return false;
        }

        return $this->name === $object->getName() &&
            $this->isoCode === $object->getIsoCode();
    }

    public function __toString() : string
    {
        return sprintf('%s (%s)', $this->name, $this->isoCode);
    }

    /**
     * {@inheritdoc}
     *
     * @return mixed[]
     */
    public function jsonSerialize() : array
    {
        return [
            'name' => $this->name,
            'code' => $this->isoCode,
        ];
    }
}
