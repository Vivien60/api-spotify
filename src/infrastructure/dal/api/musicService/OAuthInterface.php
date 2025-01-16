<?php
declare(strict_types=1);

namespace infrastructure\dal\api\musicService;

use infrastructure\dal\api\contracts\UrlForCodeAbstract;
use infrastructure\entity\TokenItem;

interface OAuthInterface
{
    public function urlForCode() : UrlForCodeAbstract;
    public function tokenFromCode(string $code): TokenItem;

}