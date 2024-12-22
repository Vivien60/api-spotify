<?php

namespace infrastructure\musicService;


use infrastructure\dal\api\contracts\internal\UrlForCodeAbstract;

interface OAuthInterface
{
    public function urlForCode() : UrlForCodeAbstract;
}