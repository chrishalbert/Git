<?php

namespace ChrisHalbert\Git\Exception;

class InvalidArgument extends \Exception implements ExceptionInterface
{
    public function __construct($message = 'Invalid argument.')
    {
        return parent::__construct($message, 400);
    }
}
