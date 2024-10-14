<?php

namespace persistenceclient\api;

interface WithRefreshTokenInterface
{
    public function getRefreshToken() : string;
}