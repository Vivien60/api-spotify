<?php

namespace model\User;

class User
{
    public readonly mixed $id;

    /**
     * @param int|mixed $id
     */
    public function __construct(mixed $id=null)
    {
        $this->id = $id?:CURRENT_SPOTIFY_ACCOUNT;
    }
}