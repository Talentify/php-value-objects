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
     * @param object|string|array $param
     */
    public function instantiateValueObject($param)
    {
        if (\is_object($param)) {
            return $param;
        }

        $reflection = new \ReflectionClass(static::getClassName());

        $param = \is_array($param) ? $param : [$param];

        $instance = $reflection->newInstanceArgs($param);
        \assert($instance instanceof ValueObject);

        return $instance;
    }

    /**
     * @param string|object $first
     * @param string|object $second
     *
     * @dataProvider sameValueDataProvider
     */
    public function testMustBeEqual($first, $second) : void
    {
        $object1 = $this->instantiateValueObject($first);
        $object2 = $this->instantiateValueObject($second);

        $this->assertTrue(
            $object1->equals($object2),
            sprintf('Failed to assert that "%s" is equal to "%s".',$object1, $object2)
        );
    }

    /**
     * @param string|object $first
     * @param string|object $second
     *
     * @dataProvider differentValueDataProvider
     */
    public function testMustNotBeEqual($first, $second) : void
    {
        $object1 = $this->instantiateValueObject($first);
        $object2 = $this->instantiateValueObject($second);

        $this->assertFalse(
            $object1->equals($object2),
            sprintf('Failed to assert that "%s" is different to "%s".',$object1, $object2)
        );
    }

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
     * @param string|object $first
     * @param string|object $second
     *
     * @dataProvider sameValueDataProvider
     */
    public function testWillBeCastedToString($first, $second) : void
    {
        $object1 = $this->instantiateValueObject($first);

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
