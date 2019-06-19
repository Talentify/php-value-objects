<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Linguistics;

use InvalidArgumentException;
use JsonSerializable;
use Talentify\ValueObject\ValueObject;

/**
 * @see https://en.wikipedia.org/wiki/Language
 */
final class Language implements JsonSerializable, ValueObject
{
    /** @var string */
    private $name;
    /** @var string */
    private $code;

    /**
     * @param string|null $code a representation of one of this codes: https://en.wikipedia.org/wiki/Language_code
     */
    public function __construct(string $name, ?string $code = null)
    {
        if ($name === '') {
            throw new InvalidArgumentException('Name should not be empty string');
        }

        $this->name = $name;
        $this->code = $code;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getCode() : ?string
    {
        return $this->code;
    }

    public function equals(?ValueObject $object) : bool
    {
        if (!$object instanceof self) {
            return false;
        }

        return $this->name === $object->getName() &&
            $this->code === $object->getCode();
    }

    public function __toString() : string
    {
        return sprintf('%s (%s)', $this->name, $this->code);
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
            'code' => $this->code,
        ];
    }
}
