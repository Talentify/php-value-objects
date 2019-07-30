<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Linguistics;

use Talentify\ValueObject\ValueObjectTestCase;

class LanguageTest extends ValueObjectTestCase
{
    public static function getClassName() : string
    {
        return Language::class;
    }

    public function sameValueDataProvider() : array
    {
        return [
            [new Language('foo'), new Language('foo')],
            [new Language('foo'), new Language('foo', null)],
        ];
    }

    public function differentValueDataProvider() : array
    {
        return [
            [new Language('foo'), new Language('bar')],
            [new Language('foo'), new Language('foo', 'BAR')],
        ];
    }
}
