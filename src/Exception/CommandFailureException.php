<?php

namespace ChrisHalbert\Git\Exception;

/**
 * Class CommandFailureException
 * @package ChrisHalbert\Git\Exception
 */
class CommandFailureException extends \Exception implements ExceptionInterface
{
    /**
     * CommandFailureException constructor.
     * @param string $message Command failed message.
     */
    public function __construct($message = 'Command failed.')
    {
        return parent::__construct($message, 400);
    }
}
