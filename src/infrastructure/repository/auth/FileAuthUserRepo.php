<?php

namespace infrastructure\repository\auth;

use infrastructure\entity\TokenItem;
use infrastructure\repository\AuthUserRepoInterface;
use model\User\User;

class FileAuthUserRepo implements AuthUserRepoInterface
{

    public string $tokenStorageFile = '';

    public function __construct(string $tokenStorageFile)
    {
        $this->tokenStorageFile = $tokenStorageFile;
    }

    public function add(TokenItem $token, ?User $user = null): void
    {
        file_put_contents($this->tokenStorageFile, json_encode($token));
        $_SESSION['token'] = json_encode($token);
    }

    public function delete(TokenItem $token): void
    {
        file_put_contents($this->tokenStorageFile, '');
        $_SESSION['token'] = null;
    }

    public function fetchById(?User $user = null) : ?TokenItem
    {
        $token = json_decode(file_get_contents($this->tokenStorageFile)?:'');
        return !empty($token) && is_object($token)? new TokenItem($token->allData, $token->accessToken, $token->refreshToken):null;
    }
}