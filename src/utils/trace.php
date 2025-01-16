<?php
declare(strict_types=1);

use GuzzleHttp\Exception\RequestException;

define('LOG_FILE', dirname(__FILE__,3)."/log/trace.log");

/**
 * @param RequestException|Exception $e
 * @param string $message
 * @return void
 */
function traceRequestException(RequestException|Exception $e, string $message): void
{
    trace(print_r($e->getRequest()->getRequestTarget(), true));
    trace(print_r($e->getRequest()->getUri(), true));
    trace(print_r($e->getRequest()->getMethod(), true));
    trace(print_r($e->getRequest()->getHeaders(), true));
    trace(print_r($e->getRequest()->getBody(), true));
}

/**
 * @param Throwable|Exception $e
 * @param string $message
 * @return void
 */
function traceException(Throwable|Exception $e, string $message): void
{
    trace($message);
    trace($e->getMessage() . ': ' . print_r($e->getTrace(), true));
    if($e->getPrevious() instanceof RequestException) {
        traceRequestException($e->getPrevious(), $e->getPrevious()->getMessage());
    }
}

function trace(string|Stringable $message) : void
{
    $date = date('Y-m-d H:i:s');
    file_put_contents(LOG_FILE, $date . ' - ' . $message."\n", FILE_APPEND | LOCK_EX);
}