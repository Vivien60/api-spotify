<?php

namespace exception;

use Exception;
use Throwable;

class AuthError extends Exception implements Throwable
{

    /**
     * @param string $msg
     * @param Throwable|null $previous
     */
    public function __construct($msg = "", Throwable $previous = null)
    {
        parent::__construct($msg, 0, $previous);
    }
}