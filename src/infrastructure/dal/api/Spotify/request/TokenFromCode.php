<?php
declare(strict_types=1);

namespace apispotify\infrastructure\dal\api\Spotify\request;

use apispotify\exception\NotFoundE;
use apispotify\infrastructure\dal\api\utils\OAuth\SecretAuth;
use Throwable;

class TokenFromCode extends TokenRequestAbstract
{
    public function __construct(SecretAuth $secretAuth, public readonly string $code, public readonly string $redirectUri)
    {
        parent::__construct($secretAuth);
    }

    /**
     * @return string[]
     */
    public function postParams(): array
    {
        return [
            'code' => $this->code,
            'redirect_uri' => $this->redirectUri,
            'grant_type' => 'authorization_code'
        ];
    }

    public function queryParams(): array
    {
        return [];
    }

    public function exception(Throwable $originException) : Throwable
    {
        return new NotFoundE(
            "Problème détecté avec l'association : " . $originException->getMessage()
        );
    }
}