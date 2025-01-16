<?php
declare(strict_types=1);

namespace apispotify\infrastructure\dal\api\musicService;

use apispotify\infrastructure\dal\api\contracts\UrlForCodeAbstract;
use apispotify\infrastructure\entity\TokenItem;

interface OAuthInterface
{
    public function urlForCode() : UrlForCodeAbstract;
    public function tokenFromCode(string $code): TokenItem;

}