<?php
declare(strict_types=1);

namespace apispotify\infrastructure\dal\api\utils\OAuth;

use apispotify\infrastructure\dal\api\contracts\UrlForCodeAbstract;
use apispotify\infrastructure\dal\api\musicService\contracts\ClientForTokenInterface;

class UrlForCode extends UrlForCodeAbstract
{
    public function __construct(ClientForTokenInterface $client, mixed $clientId, string $redirectUri)
    {
        parent::__construct($client, $clientId, $redirectUri);
    }
}