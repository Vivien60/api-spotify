<?php
declare(strict_types=1);

namespace infrastructure\dal\api\contracts;

use Throwable;

interface EndpointRequestInterface
{
    /**
     * @return string[]
     */
    public function getHeaders(): array;
    public function getEndpoint(): string;
    public function getMethod(): string;
    /**
     * @return string[]
     */
    public function postParams(): array;
    /**
     * @return string[]
     */
    public function queryParams(): array;
    public function exception(Throwable $originException) : Throwable;
}