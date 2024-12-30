<?php

namespace service;

use config\Config;
use infrastructure\entity\TokenItem;
use model\User\User;

class GetUserToken
{
    public function createUserToken(string $code): TokenItem
    {
        $me = $this->getCurrentUser();
        $service = Config::getInstance()->playlistService;
        trace(get_class($service));
        trace("aaaa");
        $token = $service->tokenFromCode(htmlentities($_GET['code']));
        trace("bbb");
        Config::getInstance()->authUserRepo->add($token, $me);
        return $token;
    }

    private function getCurrentUser(): ?User
    {
        $userRepo = Config::getInstance()->userRepo;
        return $userRepo->findCurrentUser();
    }
}