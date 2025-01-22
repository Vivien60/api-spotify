<?php
declare(strict_types=1);

namespace apispotify\infrastructure\dal\api\utils\OAuth;

use apispotify\infrastructure\dal\api\RequestAbstract;
use apispotify\infrastructure\entity\TokenItem;

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