<?php

declare(strict_types=1);

namespace Talentify\ValueObject;

trait InvalidConstructorValueAssert
{
    /**
     * @param string|object $invalidValue
     * @param string|null $exceptionMessage
     *
     * @dataProvider invalidValueDataProvider
     */
    public function testWillThrownExceptionOnInvalidValue(
        $invalidValue,
        ?string $exceptionMessage
    ) : void {
        $this->expectException(\InvalidArgumentException::class);

        if ($exceptionMessage !== null) {
            $this->expectExceptionMessage($exceptionMessage);
        }

        $this->instantiateValueObject($invalidValue);
    }

    /**
     * @return [invalid value, exception message]
     */
    abstract public function invalidValueDataProvider() : array;
}
