<?php

declare(strict_types=1);

namespace Talentify\ValueObject;

use PHPUnit\Framework\TestCase;

class StringUtilsTest extends TestCase
{
    /**
     * @dataProvider spacedValuesDataProvider
     */
    public function testMustRemoveWhitespace(string $input, string $expected) : void
    {
        $output = StringUtils::trimSpaces($input);

        $this->assertEquals(
            $output,
            $expected,
            sprintf('Failed to assert that "%s" is equal to "%s".',$input, $expected)
        );
    }

    /**
     * @dataProvider capitalizedValuesDataProvider
     */
    public function testMustCapitalize(string $input, string $expected) : void
    {
        $output = StringUtils::convertCaseToTitle($input);

        $this->assertEquals(
            $output,
            $expected,
            sprintf('Failed to assert that "%s" is equal to "%s".',$input, $expected)
        );
    }

    public function spacedValuesDataProvider() : array
    {
        return [
            [' Foo', 'Foo'],
            ['Foo ', 'Foo'],
            ['fôo ', 'fôo'],
            ['Foo_Bar', 'Foo_Bar'],
            ['Foo-Bar', 'Foo-Bar'],
            ['new    york ', 'new york'],
            ["new \n york", 'new york'],
            ["new \r york", 'new york'],
            ["new \t york", 'new york'],
            ["new \t york\r\n", 'new york'],
            ["new york\n", 'new york'],
        ];
    }

    public function capitalizedValuesDataProvider() : array
    {
        return [
            ['foo', 'Foo'],
            ['fOo', 'Foo'],
            ['NeW YoRk', 'New York'],
        ];
    }
}
