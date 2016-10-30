<?php

namespace ChrisHalbert\Git\Exception;

interface ExceptionInterface
{
    /**
     * Returns the exception message.
     * @return string
     */
    public function getMessage();

    /**
     * Returns the exception code.
     * @return int
     */
    public function getCode();
}
