<?php

namespace ChrisHalbert\Git\Exception;

class InvalidArgument extends \Exception implements ExceptionInterface
{
    public function __construct()
    {
        return parent::__construct('Invalid argument.', 400);
    }
}
