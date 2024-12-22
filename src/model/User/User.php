<?php

namespace model\User;

use config\Config;

class User
{
    public readonly mixed $id;

    /**
     * @param int|mixed $id
     */
    public function __construct(mixed $id=null)
    {
        $config = Config::getInstance();
        $this->id = $id?:$config::CURRENT_SPOTIFY_ACCOUNT;
    }
}