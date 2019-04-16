<?php

declare(strict_types=1);

namespace Talentify\ValueObject;

use PHPUnit\Framework\TestCase;

/**
 * A test case with some common tests for value objects.
 */
abstract class ValueObjectTestCase extends TestCase
{
    /**
     * @dataProvider sameValueDataProvider
     */
    public function testMustBeEqual(string $first, string $second) : void
    {
        $class = static::getClassName();

        $object1 = new $class($first);
        \assert($object1 instanceof ValueObject);
        $object2 = new $class($second);

        $this->assertTrue(
            $object1->equals($object2),
            sprintf('Failed to assert that "%s" is equal to "%s".',$object1, $object2)
        );
    }

    /**
     * @dataProvider differentValueDataProvider
     */
    public function testMustNotBeEqual(string $first, $second) : void
    {
        $class = static::getClassName();

        $object1 = new $class($first);
        \assert($object1 instanceof ValueObject);
        $object2 = new $class($second);

        $this->assertFalse(
            $object1->equals($object2),
            sprintf('Failed to assert that "%s" is different to "%s".',$object1, $object2)
        );
    }

    /**
     * @dataProvider invalidValueDataProvider
     */
    public function testWillThrownExceptionOnInvalidValue(
        string $invalidValue,
        ?string $exceptionMessage
    ) : void {
        $this->expectException(\InvalidArgumentException::class);

        if ($exceptionMessage !== null) {
            $this->expectExceptionMessage($exceptionMessage);
        }

        $class = static::getClassName();

        new $class($invalidValue);
    }

    /**
     * @dataProvider sameValueDataProvider
     */
    public function testWillBeCastedToString(string $first, string $second) : void
    {
        $class = static::getClassName();

        $object1 = new $class($first);
        \assert($object1 instanceof ValueObject);

        $this->assertEquals(
            (string)$object1,
            $second,
            sprintf('Failed to assert that "%s" is equal to "%s".',$object1, $second)
        );
    }

    /**
     * Return the class name that will be tested.
     */
    abstract public static function getClassName() : string;

    /**
     * @return [origin value, display value]
     */
    abstract public function sameValueDataProvider() : array;

    /**
     * @return [origin value, display value]
     */
    abstract public function differentValueDataProvider() : array;

    /**
     * @return [invalid value, exception message]
     */
    abstract public function invalidValueDataProvider() : array;
}
