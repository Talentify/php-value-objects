<?php

declare(strict_types=1);

namespace Tfy\ValueObject;

class StringUtils
{
    /**
     * Remove not wanted whitespace-like characters.
     *
     * @see https://en.wikipedia.org/wiki/Whitespace_character
     * @see https://en.wikipedia.org/wiki/Regular_expression#Examples
     */
    public static function trimSpaces(string $value) : ?string
    {
        // remove tab, return and new line
        $value = mb_ereg_replace('[\t\r\n]', '', trim($value));
        // replace two or more whitespaces with only one
        $value = preg_replace('!\s+!', ' ', $value);

        return empty($value) ? null : $value;
    }

    public static function removeNonWordCharacters(string $value) : string
    {
        return mb_ereg_replace("[^ \w]+", '', $value);
    }

    public static function convertCaseToTitle(string $value) : string
    {
        return mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }
}
