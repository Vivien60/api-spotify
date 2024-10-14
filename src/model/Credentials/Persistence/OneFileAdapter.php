<?php

namespace model\Credentials\Persistence;

use model\Credentials\BusinessLogic\StorageInterface;
use model\Credentials\BusinessLogic\TokenItem;

class OneFileAdapter implements StorageInterface
{
    public string $tokenStorageFile = '';

    public function __construct(string $tokenStorageFile)
    {
        $this->tokenStorageFile = $tokenStorageFile;
    }

    public function add(mixed $token): void
    {
        $tokenItem = new TokenItem($token, $token->access_token, $token->refresh_token);
        file_put_contents($this->tokenStorageFile, json_encode($tokenItem));
        $_SESSION['token'] = json_encode($token);
    }

    public function delete(mixed $token): void
    {
        file_put_contents($this->tokenStorageFile, '');
        $_SESSION['token'] = null;
    }

    public function fetch() : ?TokenItem
    {
        $token = json_decode(file_get_contents($this->tokenStorageFile)?:'');
        return !empty($token) && is_object($token)? new TokenItem($token->allData, $token->accessToken, $token->refreshToken):null;
    }
}