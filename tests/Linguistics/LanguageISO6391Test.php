<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Linguistics;

use InvalidArgumentException;
use Talentify\ValueObject\ValueObjectTestCase;

class LanguageISO6391Test extends ValueObjectTestCase
{
    public static function getClassName() : string
    {
        return LanguageISO6391::class;
    }

    public function sameValueDataProvider() : array
    {
        return [
            [new LanguageISO6391('en'), new LanguageISO6391('en')],
            [new LanguageISO6391('English', 'en'), new LanguageISO6391('English', 'en')],
        ];
    }

    public function differentValueDataProvider() : array
    {
        return [
            [new LanguageISO6391('Portuguese'), new LanguageISO6391('English')],
            [new LanguageISO6391('pt'), new LanguageISO6391('Portuguese', 'pt')],
        ];
    }

    public function testSetIsoCodeWhenNameIsIsoCode() : void
    {
        $isoLanguage = new LanguageISO6391('En');

        $this->assertEquals('En', $isoLanguage->getName());
        $this->assertEquals('en', $isoLanguage->getIsoCode());
    }

    public function testNormalizedData() : void
    {
        $isoLanguage = new LanguageISO6391('english', 'EN');

        $this->assertEquals('English', $isoLanguage->getName());
        $this->assertEquals('en', $isoLanguage->getIsoCode());
    }

    public function testNameValidation() : void
    {
        $this->expectException(InvalidArgumentException::class);

        new LanguageISO6391('');
    }

    public function testIsoCodeValidation() : void
    {
        $this->expectException(InvalidArgumentException::class);

        new LanguageISO6391('Portuguese', 'Portuguese');
    }
}
