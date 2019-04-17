<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography;

use PHPUnit\Framework\TestCase;

class CountryListTest extends TestCase
{
    /**
     * @param \Talentify\ValueObject\Geography\Country $object
     *
     * @dataProvider objectDataProvider
     */
    public function testWillReturnCountryObject($object, array $expectedData) : void
    {
        $this->assertInstanceOf(Country::class, $object);

        $this->assertEquals($object->getName(), $expectedData[0]);
        $this->assertEquals($object->getIsoAlpha2(), $expectedData[1]);
        $this->assertEquals($object->getIsoAlpha3(), $expectedData[2]);
    }

    /**
     * @return mixed[]
     */
    public function objectDataProvider() : array
    {
        return [
            [CountryList::BR(), ['Brazil', 'BR', 'BRA']],
            [CountryList::US(), ['United States Of America', 'US', 'USA']],
        ];
    }
}
