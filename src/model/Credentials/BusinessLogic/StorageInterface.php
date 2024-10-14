<?php

namespace model\Credentials\BusinessLogic;

interface StorageInterface
{
    public function add(mixed $token): void;

    public function delete(mixed $token): void;

    public function fetch() : ?TokenItem;
}