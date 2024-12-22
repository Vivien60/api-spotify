<?php

namespace infrastructure\service;

use infrastructure\dal\api\ClientAbstract;
use infrastructure\dal\api\RequestAbstract;
use infrastructure\entity\TokenItem;
use model\User\User;

class RequestToApiByUser
{
    public readonly ?TokenItem $token;

    public function __construct(
        public readonly ClientAbstract $requestFactory,
        public readonly ?User $user,
    )
    {
        $this->token = $this->repository->fetchById($this->user);
    }

    public function createRequest($requestName) : RequestAbstract
    {
        return $this->requestFactory->{$requestName}($this->token);
    }
}