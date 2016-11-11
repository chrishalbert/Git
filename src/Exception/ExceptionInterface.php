<?php

namespace ChrisHalbert\Git\Exception;

/**
 * Interface ExceptionInterface
 * @package ChrisHalbert\Git\Exception
 */
interface ExceptionInterface
{
    /**
     * Returns the exception message.
     * @return string
     */
    public function getMessage();

    /**
     * Returns the exception code.
     * @return integer
     */
    public function getCode();
}
