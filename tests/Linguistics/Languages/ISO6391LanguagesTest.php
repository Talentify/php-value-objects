<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Linguistics\Languages;

use PHPUnit\Framework\TestCase;
use Talentify\ValueObject\Linguistics\Language;

class ISO6391LanguagesTest extends TestCase
{
    public function testGetAll() : void
    {
        $obj = new ISO6391Languages();

        $results = [];
        foreach ($obj->getIterator() as $item) {
            $results[] = $item;
        }

        $this->assertCount(4, $results);
        $this->assertTrue(
            (new Language('English', 'en'))->equals($results[0])
        );
    }
}
