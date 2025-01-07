<?php

namespace service;

use service\contracts\ConfigInterface;
use infrastructure\entity\TokenItem;
use model\User\User;

class AuthenticatorService
{
    public static ConfigInterface $config;

    public function authenticate(): bool
    {
        if(!$this->isUserAuthenticated()) {
            header('Location: /coupleWithMusicService');
        }
        return true;
    }

    public function isUserAuthenticated(): bool
    {
        return (bool)self::$config->apiAuthUserInMemoryRepo->current();
    }
}