<?php
declare(strict_types=1);

namespace infrastructure\dal\api\musicService\contracts;

interface ClientForTokenInterface
{
    public const string SCOPE = '';
    public const string BASE_URI = '';

    public function getScope() : string;
}