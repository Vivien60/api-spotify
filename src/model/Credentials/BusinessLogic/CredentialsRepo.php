<?php

namespace model\Credentials\BusinessLogic;

class CredentialsRepo
{
    public function __construct(private StorageInterface $storage)
    {

    }

    public function saveIfRefreshed(TokenItem $token): void
    {
        if($token->refreshed) {
            $this->saveNewOne($token);
        }
    }

    public function saveNewOne(mixed $token): void
    {
        $this->storage->add($token);
    }

    public function ofCurrentUser():?TokenItem
    {
        return $this->storage->fetch();
    }
}