<?php

namespace ChrisHalbert\Git\Utility;

use ChrisHalbert\Git\Exception\InvalidArgumentException;

class InflectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider chainToCamelDataProvider
     */
    public function testChainToCamel($input, $expected)
    {
        $this->assertEquals($expected, Inflector::chainToCamel($input));
    }

    public function chainToCamelDataProvider()
    {
        return [
            ['branch', 'branch'],
            ['cherry-pick', 'cherryPick']
        ];
    }

    /**
     * @dataProvider camelToChainDataProvider
     */
    public function testCamelToChain($input, $expected)
    {
        $this->assertEquals($expected, Inflector::camelToChain($input));
    }

    public function camelToChainDataProvider()
    {
        return [
            ['branch', 'branch'],
            ['cherryPick', 'cherry-pick']
        ];
    }

    public function testVerifyStringThrowsError()
    {
        $this->setExpectedException(InvalidArgumentException::class);
        Inflector::chainToCamel([]);
    }
}