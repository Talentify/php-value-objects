<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Linguistics\Languages;

use Talentify\ValueObject\Linguistics\Language;

/**
 * Represents a list of languages.
 */
interface Languages extends \IteratorAggregate
{
    /**
     * Checks whether the list contains a specific language.
     */
    public function contains(Language $language) : bool;
}
