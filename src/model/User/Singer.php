<?php
declare(strict_types=1);

namespace apispotify\model\User;

use apispotify\service\contracts\ConfigInterface;

class Singer
{
    public readonly mixed $spotifyAccount;

    public readonly User $user;

    public static ConfigInterface $config;

    public function __construct(?User $user = null, $spotifyAccount = null)
    {
        $this->user = $user?:new User();
        $this->spotifyAccount = $spotifyAccount?:self::$config->currentSpotifyAccount;
    }
}