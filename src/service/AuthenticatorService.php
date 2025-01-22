<?php
declare(strict_types=1);

namespace apispotify\service;

use apispotify\service\contracts\ConfigInterface;

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