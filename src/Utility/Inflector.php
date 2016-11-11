<?php

namespace ChrisHalbert\Git\Utility;

use ChrisHalbert\Git\Exception\InvalidArgumentException;

/**
 * Class Inflector
 * @package ChrisHalbert\Git\Utility
 */
final class Inflector
{
    /**
     * Converts chain-case to camelCase.
     * @param string $chain A chain-cased-string.
     * @return string
     */
    public static function chainToCamel($chain)
    {
        self::verifyString($chain);
        return lcfirst(preg_replace('/ /', '', ucwords(preg_replace('/[-]/', ' ', $chain))));
    }

    /**
     * Converts camelCase to chain-case.
     * @param string $camel A chain-cased-string.
     * @return string
     */
    public static function camelToChain($camel)
    {
        self::verifyString($camel);
        return strtolower(implode('-', preg_split('/(?=[A-Z])/', $camel)));
    }

    /**
     * Verifies parameter is a string or throw an exception.
     * @param string $string A string.
     * @throws InvalidArgumentException If a non-string is passed.
     * @return void
     */
    private static function verifyString($string)
    {
        if (!is_string($string)) {
            throw new InvalidArgumentException('Argument must be of type string, ' . gettype($string) . ' given.');
        }
    }
}
