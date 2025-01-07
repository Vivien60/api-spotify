<?php
declare(strict_types=1);

namespace infrastructure\dal\api\musicService\contracts;

use infrastructure\dal\api\RequestAbstract;
use model\Song\Song as SongItem;

interface SongRqFactoryInterface
{
    public function lyrics(SongItem $song):RequestAbstract;
}