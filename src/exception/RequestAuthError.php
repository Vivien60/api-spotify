<?php
declare(strict_types=1);

namespace apispotify\exception;

use Exception;
use Throwable;

class RequestAuthError extends Exception
{
    public function __construct(string $msg = "", ?Throwable $previous = null)
    {
        parent::__construct($msg, 0, $previous);
    }
}