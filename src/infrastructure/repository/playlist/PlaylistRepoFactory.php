<?php

namespace infrastructure\repository\playlist;

class PlaylistRepoFactory
{
    public static function createDefault(): PlaylistRepoInterface
    {
        return new PlaylistApiRepo();
    }
}