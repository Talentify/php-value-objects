<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Linguistics\Languages;

use ArrayIterator;
use RuntimeException;
use Talentify\ValueObject\Linguistics\Language;
use Traversable;

/**
 * List of all languages defined by ISO 639-1.
 *
 * @see https://en.wikipedia.org/wiki/ISO_639-1
 */
class ISO6391Languages implements Languages
{
    /**
     * Map of known languages indexed by code.
     *
     * @var array
     */
    private static $languages;

    /**
     * {@inheritdoc}
     */
    public function contains(Language $language) : bool
    {
        return isset($this->getLanguages()[$language->getCode()]);
    }

    public function getIterator() : Traversable
    {
        return new ArrayIterator(
            array_map(
                function ($definition) {
                    return new Language($definition['name'], $definition['code']);
                },
                $this->getLanguages()
            )
        );
    }

    /**
     * Returns a map of known languages indexed by code.
     *
     * @return mixed[]
     */
    private function getLanguages() : array
    {
        if (null === self::$languages) {
            self::$languages = $this->loadLanguages();
        }

        return self::$languages;
    }

    /**
     * @return mixed[]
     */
    private function loadLanguages() : array
    {
        $file = __DIR__ . '/../../../resources/languages/iso6391.php';

        if (file_exists($file)) {
            return require $file;
        }

        throw new RuntimeException('Failed to load language ISO 639-1 codes.');
    }
}
