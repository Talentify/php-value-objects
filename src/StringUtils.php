<?php

declare(strict_types=1);

namespace Talentify\ValueObject;

/**
 * @internal
 */
class StringUtils
{
    /**
     * Remove not wanted whitespace-like characters.
     *
     * @see https://en.wikipedia.org/wiki/Whitespace_character
     * @see https://en.wikipedia.org/wiki/Regular_expression#Examples
     */
    public static function trimSpacesWisely(string $value) : ?string
    {
        // remove tab, return and new line
        $value = mb_ereg_replace('[\t\r\n]', '', trim($value));
        // replace two or more whitespaces with only one
        $value = preg_replace('!\s+!', ' ', $value);

        return empty($value) ? null : $value;
    }

    public static function removeSpaces(string $value) : ?string
    {
        return mb_ereg_replace('\s', '', $value);
    }

    public static function removeNonWordCharacters(string $value) : string
    {
        return mb_ereg_replace("[^ \w]+", '', $value);
    }

    public static function convertCaseToTitle(string $value) : string
    {
        return mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }

    public static function convertCaseToUpper(string $value) : string
    {
        return mb_convert_case($value, MB_CASE_UPPER, 'UTF-8');
    }

    public static function convertCaseToLower(string $value) : string
    {
        return mb_convert_case($value, MB_CASE_LOWER, 'UTF-8');
    }

    public static function countCharacters(string $value) : int
    {
        return strlen($value);
    }
}
