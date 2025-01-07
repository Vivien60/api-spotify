<?php
declare(strict_types=1);

namespace infrastructure\dal\api\Spotify\request;

use Exception;
use exception\NotFoundE;
use infrastructure\dal\api\utils\OAuth\RequestWithBearerTokenAbstract;
use infrastructure\entity\TokenItem;
use Throwable;

class PlaylistTracks extends RequestWithBearerTokenAbstract
{
    public function __construct(TokenItem $token, public string|int $idPlaylist)
    {
        parent::__construct($token);
        $this->endpoint = "playlists/$this->idPlaylist/tracks";
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

    /**
     * @return string[]
     */
    public function queryParams(): array
    {
        return $this->queryParams;
    }

    public function exception(Exception|Throwable $originException) : Throwable
    {
        return new NotFoundE(
            "Playlist not found.", 0, $originException
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
}