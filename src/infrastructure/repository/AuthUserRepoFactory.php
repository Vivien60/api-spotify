<?php

namespace infrastructure\repository;

use infrastructure\repository\auth\FileAuthUserRepo;

class AuthUserRepoFactory
{
    public static function create() : AuthUserRepoInterface
    {
        return new FileAuthUserRepo(TOKEN_STORAGE_FILE);
    }
}