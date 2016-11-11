<?php

namespace ChrisHalbert\Git\Exception;

/**
 * Class InvalidArgumentException
 * @package ChrisHalbert\Git\Exception
 */
class InvalidArgumentException extends \Exception implements ExceptionInterface
{
    /**
     * InvalidArgumentException constructor.
     * @param string $message A message to set.
     */
    public function __construct($message = 'Invalid argument.')
    {
        return parent::__construct($message, 400);
    }
}
