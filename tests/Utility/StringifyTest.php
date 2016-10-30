<?php

namespace ChrisHalbert\Git\Utility;

use ChrisHalbert\Git\Exception\InvalidArgument;

class StringifyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider testArgumentsDataProvider
     */
    public function testArguments($input, $expected)
    {
        $this->assertEquals($expected, Stringify::arguments($input));
    }

    public function testArgumentsDataProvider()
    {
        return [
            [
                "--arg=123 -A=1 -- argument",
                "--arg=123 -A=1 -- argument"
            ],
            [
                ["--arg" => 123, "-A" => 1, "--" => null, "argument" => ''],
                "--arg=123 -A=1 -- argument"
            ]
        ];
    }

    public function testArgumentsThrowsInvalidArgument()
    {
        $this->setExpectedException(InvalidArgument::class, 'Invalid argument.', 400);
        Stringify::arguments((object)[]);
    }
}