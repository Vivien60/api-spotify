<?php

namespace infrastructure\musicService;


use infrastructure\dal\api\contracts\UrlForCodeAbstract;

interface OAuthInterface
{
    public function urlForCode() : UrlForCodeAbstract;
}