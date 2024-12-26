<?php

namespace infrastructure\dal\api\musicService\contracts;

use infrastructure\dal\api\RequestAbstract;
use model\Song\Song as SongItem;

interface SongRqFactoryInterface extends RequestFactoryInterface
{
    public function lyrics(SongItem $song):RequestAbstract;
}