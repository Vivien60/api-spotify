<?php

namespace persistenceclient\api;

use Throwable;

interface RequestEndpointInterface
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