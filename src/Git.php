<?php

namespace ChrisHalbert\Git;

use ChrisHalbert\Git\Exception\InvalidCommandComposition;
use ChrisHalbert\Git\Utility\Inflector;
use ChrisHalbert\Git\Utility\Stringify;

class Git
{
    const SUCCESS = 0;

    public function __call($method, $args)
    {
        $command = Inflector::camelToChain($method);
        return $this->command($command, $args);
    }

    public function blame($file, $line)
    {
        $blameCommand = sprintf("-L%s,%s --line-porcelain -- %s", $line, $line, $file);
        return $this->command('blame', $blameCommand);
    }

    /**
     * @param $command
     * @param $args
     */
    private function command($command, $args)
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
