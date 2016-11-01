<?php

namespace ChrisHalbert\Git\Exception;

class InvalidCommandComposition extends \Exception implements ExceptionInterface
{
    public function __construct($message = 'Invalid command composition.')
    {
        return parent::__construct($message, 400);
    }
}
