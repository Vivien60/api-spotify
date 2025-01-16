<?php
declare(strict_types=1);

namespace infrastructure\dal\api\utils\OAuth;

use infrastructure\dal\api\contracts\UrlForCodeAbstract;
use infrastructure\dal\api\musicService\contracts\ClientForTokenInterface;

class UrlForCode extends UrlForCodeAbstract
{
    public function __construct(ClientForTokenInterface $client, mixed $clientId, string $redirectUri)
    {
        parent::__construct($client, $clientId, $redirectUri);
    }
}