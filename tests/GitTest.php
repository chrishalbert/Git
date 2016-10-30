<?php

namespace ChrisHalbert\Git;

use ChrisHalbert\Git\Exception\InvalidCommandComposition;

class GitTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $stub = $this->getMockBuilder(Git::class);
        $this->git= $stub->setMethods(['execute'])
            ->getMock();
    }

    public function tearDown()
    {
        unset($this->git);
    }

    public function testBlame()
    {
        $this->git->expects($this->once())
            ->method('execute')
            ->with('git blame -L1,1 --line-porcelain -- example.file')
            ->willReturn(['Worked', Git::SUCCESS]);

        $this->git->blame('example.file', 1);
    }

    public function testThrowsInvalidCommandComposition()
    {
        $this->setExpectedException(InvalidCommandComposition::class);
        $failure = !Git::SUCCESS;
        $this->git->expects($this->once())
            ->method('execute')
            ->with('git bad-command')
            ->willReturn(['Worked', $failure]);

        $this->git->badCommand();
    }

    public function testMagicMethodDiff()
    {
        $this->git->expects($this->once())
            ->method('execute')
            ->with('git diff');

        $this->git->diff();
    }
}