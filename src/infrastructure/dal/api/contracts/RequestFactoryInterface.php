<?php

namespace infrastructure\dal\api\contracts;


use infrastructure\dal\api\RequestAbstract;
use infrastructure\dal\api\TokenItem;

interface RequestFactoryInterface
{
    public function query($type, mixed $auth) : RequestAbstract;
    public function playlistsMine(TokenItem $token) : RequestAbstract;

    public function playlistTracks(mixed $clientId, mixed $clientSecret, TokenItem $token) : RequestAbstract;

    public function refreshToken(mixed $clientId, mixed $clientSecret, TokenItem $token) : RequestAbstract;

    public function tokenFromCode(mixed $clientId, mixed $clientSecret, TokenItem $token) : RequestAbstract;
}