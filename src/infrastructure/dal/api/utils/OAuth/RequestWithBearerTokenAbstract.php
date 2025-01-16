<?php
declare(strict_types=1);

namespace apispotify\infrastructure\dal\api\utils\OAuth;

use apispotify\infrastructure\dal\api\contracts\EndpointRequestInterface;
use apispotify\infrastructure\dal\api\RequestAbstract;
use apispotify\infrastructure\entity\TokenItem;

abstract class RequestWithBearerTokenAbstract extends RequestAbstract implements WithBearerTokenInterface, EndpointRequestInterface
{
    public BearerToken $bearerToken {
        get => $this->bearerToken??= BearerToken::fromTokenItem($this->token);
    }

    public function __construct(readonly TokenItem $token)
    {
        $this->headers = [
            'Authorization' => 'Bearer ' . $this->bearerToken,
        ];
        parent::__construct();
    }

    /**
     * @return string[]
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

}