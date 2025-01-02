<?php

namespace service;

use service\contracts\ConfigInterface;
use infrastructure\entity\TokenItem;
use model\User\User;

class GetUserToken
{
    public static ConfigInterface $config;
    public function createUserToken(string $code): TokenItem
    {
        $me = $this->getCurrentUser();
        $service = self::$config->playlistService;
        $token = $service->tokenFromCode(htmlentities($_GET['code']));
        self::$config->authUserRepo->add($token, $me);
        return $token;
    }

    private function getCurrentUser(): ?User
    {
        $userRepo = self::$config->userRepo;
        return $userRepo->findCurrentUser();
    }
}