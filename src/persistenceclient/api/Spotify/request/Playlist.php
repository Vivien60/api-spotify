<?php

namespace persistenceclient\api\Spotify\request;

use exception\NotFoundE, Throwable;
use model\Credentials\BusinessLogic\TokenItem;
use persistenceclient\api\RequestWithBearerTokenAbstract;

class Playlist extends RequestWithBearerTokenAbstract
{
    public function __construct(TokenItem $token, public string|int $idPlaylist)
    {
        parent::__construct($token);
        $this->endpoint = "playlists/$this->idPlaylist";
        $this->postParams = [];
        $this->queryParams = [];
        $this->method = "GET";
    }

    /**
     * @return string[]
     */
    public function postParams(): array
    {
        return $this->postParams;
    }

    public function queryParams(): array
    {
        return $this->queryParams;
    }

    public function exception(Throwable $originException) : Throwable
    {
        return new NotFoundE(
            "Playlist not found : " . $originException->getMessage()
        );
    }

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    public function getMethod(): string
    {
        return "GET";
    }

    public static function mine(TokenItem $token): self
    {
        $myPlaylists = new self($token, "me");
        $myPlaylists->endpoint = "me/playlists";
        return $myPlaylists;
    }
}