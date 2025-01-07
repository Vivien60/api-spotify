<?php
declare(strict_types=1);

namespace exception;

use Exception;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Client\RequestExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Throwable;

class RequestAuthError extends Exception
{
    public function __construct(string $msg = "", ?Throwable $previous = null)
    {
        parent::__construct($msg, 0, $previous);
    }
}