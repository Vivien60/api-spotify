<?php
declare(strict_types=1);

namespace apispotify\exception;

use Exception;
use Throwable;

class NotFoundE extends Exception implements Throwable
{
    public function __construct(string $message = "", int $code = 0, ?Exception $previous = null)   {
        parent::__construct($message, $code, $previous);
    }
}