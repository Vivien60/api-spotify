<?php

namespace model\User;

class Singer
{
    public readonly mixed $spotifyAccount;

    public readonly User $user;

    public function __construct(?User $user = null, $spotifyAccount = null)
    {
        $this->user = $user?:new User();
        $this->spotifyAccount = $spotifyAccount?:CURRENT_SPOTIFY_ACCOUNT;
    }

}