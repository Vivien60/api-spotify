<?php
declare(strict_types=1);

namespace infrastructure\dal\api\utils\OAuth;

use infrastructure\dal\api\contracts\internal\WithRefreshTokenInterface;
use infrastructure\dal\api\RequestAbstract;
use infrastructure\entity\TokenItem;

abstract class RequestWithRefreshTokenAbstract extends RequestAbstract implements WithRefreshTokenInterface
{
    public RefreshToken $refreshToken {
        get => $this->refreshToken??= RefreshToken::fromTokenItem($this->token);
    }

    public function __construct(readonly TokenItem $token)
    {
        parent::__construct();
    }

    /**
     * @return string[]
     */
    public function getHeaders(): array
    {
        return [
            'Authorization' => 'Bearer ' . $this->getRefreshToken(),
        ];
    }

    public function getRefreshToken(): string
    {
        return $this->token;
    }
}