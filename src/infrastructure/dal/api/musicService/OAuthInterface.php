<?php

namespace infrastructure\dal\api\musicService;

use infrastructure\dal\api\contracts\internal\UrlForCodeAbstract;
use infrastructure\entity\TokenItem;

interface OAuthInterface
{
    public function urlForCode() : UrlForCodeAbstract;
    public function tokenFromCode(string $code): TokenItem;

}