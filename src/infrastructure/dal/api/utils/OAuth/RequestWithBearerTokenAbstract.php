<?php
declare(strict_types=1);

namespace infrastructure\dal\api\utils\OAuth;

use infrastructure\dal\api\contracts\internal\EndpointRequestInterface;
use infrastructure\dal\api\contracts\internal\WithBearerTokenInterface;
use infrastructure\dal\api\RequestAbstract;
use infrastructure\entity\TokenItem;

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