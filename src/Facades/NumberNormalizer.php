<?php

namespace NumberNormalizer\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string toEnglish(string $string, ?array $languages = null)
 * @method static string withMapping(string $string, array $mapping)
 * @method static array getMergedMapping()
 * @method static array getAllMappings()
 *
 * @see \NumberNormalizer\NumberNormalizer
 */
class NumberNormalizer extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \NumberNormalizer\NumberNormalizer::class;
    }
}
