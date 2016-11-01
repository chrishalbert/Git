<?php

namespace ChrisHalbert\Git;

use ChrisHalbert\Git\Exception\InvalidArgument;
use ChrisHalbert\Git\Exception\InvalidCommandComposition;
use ChrisHalbert\Git\Utility\Inflector;
use ChrisHalbert\Git\Utility\Stringify;

class Git
{
    /**
     * Git/CLI Success code.
     * @const integer 0
     */
    const SUCCESS = 0;

    /**
     * Magic method to call git commands if they do not exist in this class.
     * @param string $gitCommand The git command.
     * @param array  $args       Args passed to the git command.
     * @return string
     * @throws InvalidArgument If extra parameters are passed to the method.
     */
    public function __call($gitCommand, $args)
    {
        $gitArgs = array_shift($args);

        // Only one parameter should be passed to magic methods.
        if (sizeof($args) > 0) {
            throw new InvalidArgument('Magic methods requires no more than 1 argument.');
        }

        if ($gitArgs === null) {
            $gitArgs = '';
        }

        $command = Inflector::camelToChain($gitCommand);
        return $this->command($command, $gitArgs);
    }

    public function blameBus($file, $line)
    {
        $blameCommand = sprintf("-L%s,%s --line-porcelain -- %s", $line, $line, $file);
        return $this->command('blame', $blameCommand);
    }

    /**
     * @param $command
     * @param $args
     */
    protected function command($command, $args)
    {
        $command = trim(sprintf('git %s %s', $command, Stringify::arguments($args)));
        list($output, $return) = $this->execute($command);
        if ($return != self::SUCCESS) {
            throw new InvalidCommandComposition();
        }

        return $output;
    }

    /**
     * @codeCoverageIgnore
     */
    protected function execute($command)
    {
        exec($command, $output, $return);
        return [$output, $return];
    }
}
