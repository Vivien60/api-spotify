<?php
declare(strict_types=1);

namespace apispotify\infrastructure\dal\api;

use Exception;
use apispotify\infrastructure\dal\api\contracts\EndpointRequestInterface;
use Throwable;

abstract class RequestAbstract implements EndpointRequestInterface
{
    public string $endpoint = '';
    public string $method = '';
    /**
     * @var string[]
     */
    public array $headers = [];
    /**
     * @var string[]
     */
    public array $postParams = [];
    /**
     * @var string[]
     */
    public array $queryParams = [];

    public function __construct()
    {
    }

    /**
     * @return string[]
     */
    abstract public function getHeaders(): array;
    abstract public function getEndpoint() : string;
    abstract public function getMethod() : string;
    /**
     * @return array<string, mixed>
     */
    abstract public function postParams(): array;
    /**
     * @return string[]
     */
    abstract public function queryParams(): array;
    abstract public function exception(Exception|Throwable $originException) : Throwable;
}