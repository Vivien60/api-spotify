<?php
declare(strict_types=1);

namespace service;

use exception\RequestAuthError;
use infrastructure\dal\api\contracts\internal\UrlForCodeAbstract;
use infrastructure\dal\api\musicService\OAuthInterface;
use service\contracts\ConfigInterface;
use infrastructure\entity\TokenItem;
use model\User\User;

class OAuthService
{
    public static ConfigInterface $config;

    public function processForCodeDemand(OAuthInterface $service): UrlForCodeAbstract
    {
        $urlRedirect = $service->urlForCode();
        $this->storeState($urlRedirect);

        return $urlRedirect;
    }

    /**
     * @param UrlForCodeAbstract $urlRedirect
     * @return void
     */
    protected function storeState(UrlForCodeAbstract $urlRedirect): void
    {
        trace('processForCodeDemand : '.$urlRedirect->urlParams['state']);
        //session_regenerate_id();
        $_SESSION['state'] = $urlRedirect->urlParams['state'];
    }

    /**
     * @throws RequestAuthError
     */
    public function createUserToken($code, array $security, OAuthInterface $service): TokenItem
    {
        trace('createUserToken : '.$security['state']);
        if(!$this->verifyCodeDemandResponse($security['state'])) {
            throw new RequestAuthError("Il y a eu un problème lors de la demande du code d'échange");
        }
        $me = $this->getCurrentUser();
        $token = $service->tokenFromCode($code);
        self::$config->apiAuthUserRepo->add($token, $me);
        self::$config->apiAuthUserInMemoryRepo->add($token, $me);
        return $token;
    }

    private function getCurrentUser(): ?User
    {
        $userRepo = self::$config->userRepo;
        return $userRepo->findCurrentUser();
    }

    public function verifyCodeDemandResponse($state) : bool
    {
        return $state == $this->stateFromStorage();
    }

    protected function stateFromStorage()
    {
        return $_SESSION['state'];
    }
}