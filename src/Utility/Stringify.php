<?php

namespace ChrisHalbert\Git\Utility;

use ChrisHalbert\Git\Exception\InvalidArgumentException;

/**
 * Class Stringify
 * @package ChrisHalbert\Git\Utility
 */
class Stringify
{
    /**
     * Converts an array of options/flags into a string.
     * @param array|string $args A string of a raw command or an assoc array of key value options.
     * @return string A raw command.
     * @throws InvalidArgumentException If $args is not a string or array.
     */
    public static function arguments($args)
    {
        $argList = '';

        // If its a string return it
        if (is_string($args)) {
            return $args;
        }

        // If its not an array, Houston, we have a problem
        if (!is_array($args)) {
            throw new InvalidArgumentException();
        }

        // Build the argument list
        foreach ($args as $arg => $val) {
            $argList .= ' ' . $arg;
            if (!empty($val)) {
                $argList .= ' ' . $val;
            }
        }

        return trim($argList);
    }
}
