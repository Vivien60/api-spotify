<?php

namespace persistenceclient\api\Spotify\utils;

use persistenceclient\api\Spotify\client\ClientForToken;
use Random\RandomException;
use Stringable;

class UrlForCode implements Stringable
{
    public const string SCOPE = 'user-library-modify app-remote-control playlist-modify-private playlist-modify-public playlist-read-collaborative playlist-read-private streaming user-follow-read user-library-read user-modify-playback-state user-read-currently-playing user-read-email user-read-playback-position user-read-playback-state user-read-private user-read-recently-played user-top-read';


    public function __construct(private ClientForToken $spotifyApiToken, private mixed $clientId, private string $redirectUri)
    {
    }

    /**
     * Magic method {@see https://www.php.net/manual/en/language.oop5.magic.php#object.tostring}
     * allows a class to decide how it will react when it is treated like a string.
     *
     * @return string Returns string representation of the object that
     * implements this interface (and/or "__toString" magic method).
     */
    public function __toString(): string
    {
        return $this->url();
    }

    public function url(): string
    {
        $query = $this->buildCodeRequestParams();
        return $this->buildCodeRequestUrl($query);
    }

    /**
     * @return mixed[]
     * @throws RandomException
     */
    public function buildCodeRequestParams(): array
    {
        return array(
            'response_type' => 'code',
            'client_id' => $this->clientId,
            'scope' => self::SCOPE,
            'redirect_uri' => $this->redirectUri,
            'state' => bin2hex(random_bytes(5)), //@TODO Vivien : mettre le state en session
        );
    }

    /**
     * @param array<mixed> $query
     * @return string
     */
    public function buildCodeRequestUrl(array $query): string
    {
        return $this->spotifyApiToken::BASE_URI . 'authorize?' . http_build_query($query);
    }
}