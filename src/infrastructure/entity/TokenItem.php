<?php
declare(strict_types=1);

namespace apispotify\infrastructure\entity;

use JsonSerializable;
use stdClass;

class TokenItem implements JsonSerializable
{
    public string $refreshToken;
    public string $accessToken;
    public Object $allData;
    public bool $refreshed = false;


    public function __construct(Object $allData, string $accessToken, string $refreshToken, bool $refreshed = false)
    {
        $this->refreshToken = $refreshToken;
        $this->accessToken = $accessToken;
        $this->allData = $allData;
        $this->refreshed = $refreshed;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4
     * @return array{refreshToken: string, accessToken: string, allData: stdClass}
     */
    public function jsonSerialize(): array
    {
        return [
            'refreshToken' => $this->refreshToken,
            'accessToken' => $this->accessToken,
            'allData' => $this->allData,
        ];
    }
}