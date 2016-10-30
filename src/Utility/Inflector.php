<?php

namespace ChrisHalbert\Git\Utility;

final class Inflector
{
    /**
     * Converts chain to camel case.
     * @param $chain
     * @return string
     */
    public static function chainToCamel($chain)
    {
          return lcfirst(preg_replace('/ /', '', ucwords(preg_replace('/[^0-9a-zA-Z]/', ' ', $chain))));
    }

    public static function camelToChain($camel)
    {
        return strtolower(implode('-', preg_split('/(?=[A-Z])/', $camel)));
    }
}
