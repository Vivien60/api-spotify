<?php
declare(strict_types=1);

namespace apispotify\infrastructure\dal\api\LyricsOvh\request;

use Exception;
use apispotify\exception\NotFoundE;
use apispotify\infrastructure\dal\api\RequestAbstract;
use Throwable;

class Lyrics extends RequestAbstract
{
    public string $method = "GET";
    /**
     * paramètres envoyés par méthode POST
     * @var string[]
     */
    public array $postParams = [];
    /**
     * paramètres GET dans l'url
     * @var string[]
     */
    public array $queryParams = [];
    /**
     * @var string[]
     */
    public array $headers = [];

    /**
     * @param string $artist
     * @param string $title
     */
    public function __construct(string $artist, string $title)
    {
        parent::__construct();
        $this->endpoint = "$artist/$title";
    }

    /**
     * @return string[]
     */
    public function postParams(): array
    {
        return $this->postParams;
    }

    /**
     * @return string[]
     */
    public function queryParams(): array
    {
        return $this->queryParams;
    }

    public function exception(Exception|Throwable $originException) : NotFoundE
    {
        return new NotFoundE(
            "Lyrics not found.", 0, $originException
        );
    }

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string[]
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }
}