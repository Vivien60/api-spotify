<?php

namespace infrastructure\dal\api\Spotify\request;

use infrastructure\dal\api\contracts\RequestFactoryInterface;
use infrastructure\dal\api\RequestAbstract;

abstract class RequestFactoryAbstract implements RequestFactoryInterface
{

    public function query($type, mixed $auth) : RequestAbstract
    {
        switch($type) {
            case "playlistMine":
                return $this->playlistsMine($auth);
        }
    }
}