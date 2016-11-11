<?php

namespace ChrisHalbert\Git;

use ChrisHalbert\Git\Exception\CommandFailureException;
use ChrisHalbert\Git\Exception\InvalidArgumentException;

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

        $this->git->blameBus('example.file', 1);
    }

    public function testThrowsInvalidCommandComposition()
    {
        $this->setExpectedException(CommandFailureException::class);
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

    public function testInvalidArgumentThrownWithTooManyArgs()
    {
        $this->setExpectedException(InvalidArgumentException::class);
        $this->git->checkout('-b', 'branch', 'remote/branch');
    }

    public function testReadmeExample()
    {
        $this->git->expects($this->exactly(2))
            ->method('execute')
            ->with('git blame -L=20,20 example.php')
            ->willReturn('Success!');
        $diff1 = $this->git->blame('-L=20,20 example.php');
        $diff2 = $this->git->blame(['-L' => '20,20', 'example.php' => null]);
        $this->assertEquals($diff1, $diff2);
    }
}