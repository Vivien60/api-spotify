<?php

namespace infrastructure\dal\api\contracts\internal;

use infrastructure\dal\api\ClientAbstract;
use infrastructure\dal\api\Spotify\client\ClientForToken;
use Random\RandomException;

class UrlForCodeAbstract
{
    public const string SCOPE = '';

    public function __construct(private ClientForToken $client, private mixed $clientId, private string $redirectUri)
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
            'scope' => $this->client->getScope(),
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
        return $this->client->getBaseUri() . 'authorize?' . http_build_query($query);
    }
}