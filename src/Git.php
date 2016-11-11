<?php

namespace ChrisHalbert\Git;

use ChrisHalbert\Git\Exception\CommandFailureException;
use ChrisHalbert\Git\Exception\InvalidArgumentException;
use ChrisHalbert\Git\Exception\InvalidCommandComposition;
use ChrisHalbert\Git\Utility\Inflector;
use ChrisHalbert\Git\Utility\Stringify;

/**
 * Class Git
 * @package ChrisHalbert\Git
 */
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
     * @throws InvalidArgumentException If extra parameters are passed to the method.
     */
    public function __call($gitCommand, array $args)
    {
        $gitArgs = array_shift($args);

        // Only one parameter should be passed to magic methods.
        if (sizeof($args) > 0) {
            throw new InvalidArgumentException('Magic methods requires no more than 1 argument.');
        }

        if ($gitArgs === null) {
            $gitArgs = '';
        }

        $command = Inflector::camelToChain($gitCommand);
        return $this->command($command, $gitArgs);
    }

    /**
     * Returns information on the last edit of a file and line.
     * @param string  $file The file in question.
     * @param integer $line The line number in the file.
     * @return string The output of the command.
     * @throws CommandFailureException If the command failed.
     */
    public function blameBus($file, $line)
    {
        $blameCommand = sprintf("-L%s,%s --line-porcelain -- %s", $line, $line, $file);
        return $this->command('blame', $blameCommand);
    }

    /**
     * Returns output from a command.
     * @param string       $command A git command.
     * @param string|array $args    An array or string of arguments.
     * @return string The response if any from the git command.
     * @throws CommandFailureException If the command failed.
     */
    protected function command($command, $args)
    {
        $command = trim(sprintf('git %s %s', $command, Stringify::arguments($args)));
        list($output, $return) = $this->execute($command);
        if ($return != self::SUCCESS) {
            throw new CommandFailureException($output);
        }

        return trim($output);
    }

    /**
     * Executes a git command.
     * @param string $command The command to execute.
     * @return array The output of a git command and the return value.
     * @codeCoverageIgnore
     */
    protected function execute($command)
    {
        exec($command, $output, $return);
        return [$output, $return];
    }
}
