<?php
declare(strict_types=1);

namespace apispotify\infrastructure\dal\api\Spotify\request;

use apispotify\exception\NotFoundE;
use apispotify\infrastructure\dal\api\utils\OAuth\RequestWithBearerTokenAbstract;
use apispotify\infrastructure\entity\TokenItem;
use Throwable;

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
        $myPlaylists = new static($token, "me");
        $myPlaylists->endpoint = "me/playlists";
        return $myPlaylists;
    }
}