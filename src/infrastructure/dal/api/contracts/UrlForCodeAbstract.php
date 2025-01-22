<?php
declare(strict_types=1);

namespace apispotify\infrastructure\dal\api\contracts;

use apispotify\infrastructure\dal\api\Spotify\client\ClientForToken;
use Random\RandomException;

class UrlForCodeAbstract
{
    public const string SCOPE = '';

    public array $urlParams = [];

    /**
     * @throws RandomException
     */
    public function __construct(private ClientForToken $client, private mixed $clientId, private string $redirectUri)
    {
        $this->buildCodeRequestParams();
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
        return $this->buildCodeRequestUrl($this->urlParams);
    }

    /**
     * @throws RandomException
     */
    public function buildCodeRequestParams(): void
    {
        $this->urlParams = [
            'response_type' => 'code',
            'client_id' => $this->clientId,
            'scope' => $this->client->getScope(),
            'redirect_uri' => $this->redirectUri,
            'state' => bin2hex(random_bytes(5)),
        ];
    }

    /**
     * @param array<mixed> $query
     * @return string
     */
    public function buildCodeRequestUrl(array $query): string
    {
        return $this->client->getBaseUri() . 'authorize?' . http_build_query($query);
    }
}