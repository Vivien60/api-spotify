<?php

namespace service;

use config\Config;
use model\User\User;

class GetUserToken
{
    public function createUserToken(string $code): array
    {
        $me = $this->getCurrentUser();
        $service = \config\Config::getInstance()->playlistService;
        $token = $service->tokenFromCode(htmlentities($_GET['code']));
    }

    private function getCurrentUser(): ?User
    {
        $userRepo = Config::getInstance()->userRepo;
        return $userRepo->findCurrentUser();
    }
}