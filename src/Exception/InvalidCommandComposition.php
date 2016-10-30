<?php

namespace ChrisHalbert\Git\Exception;

class InvalidCommandComposition extends \Exception implements ExceptionInterface
{
    public function __construct()
    {
        return parent::__construct('Invalid command composition.', 400);
    }
}
