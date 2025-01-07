<?php
declare(strict_types=1);

namespace model\User;

use service\contracts\ConfigInterface;

class User
{
    public static ConfigInterface $config;
    public readonly mixed $id;

    /**
     * @param int|mixed $id
     */
    public function __construct(mixed $id=null)
    {
        $this->id = $id?:self::$config->currentSpotifyAccount;
    }
}