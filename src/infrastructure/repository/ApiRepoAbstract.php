<?php

namespace infrastructure\repository;

use infrastructure\dal\api\ClientAbstract;
use infrastructure\dal\api\ClientFactory;
use infrastructure\dal\api\contracts\RequestFactoryInterface;
use infrastructure\dal\api\RequestAbstract;
use infrastructure\dal\api\utils\RequestFactoryProvider;
use infrastructure\entity\TokenItem;
use model\Playlist\Playlist as PlaylistItem;
use model\User\User;
use Psr\Http\Message\ResponseInterface;

abstract class ApiRepoAbstract
{
    protected AuthUserRepoInterface $authUserRepo;
    protected RequestFactoryInterface $requestFactory;
    protected ClientAbstract $client;

    public function __construct()
    {
        $this->authUserRepo = AuthUserRepoFactory::create();
        $this->requestFactory = RequestFactoryProvider::create();
        $this->client = ClientFactory::fromType($this->requestType());
    }


    /**
     * @param User $user
     * @return ResponseInterface
     * @throws \Throwable
     */
    protected function queryWithUserAuth(User $user): ResponseInterface
    {
        $request = $this->requestWithAuth($user, 'playlistsMine');
        $results = $this->client->sendRequest($request);
        return $results;
    }

    /**
     * @param User $user
     * @param string $type
     * @return RequestAbstract
     */
    protected function requestWithAuth(User $user, string $type): RequestAbstract
    {
        $auth = $this->authUser($user);
        return $this->requestFactory->query($type, $auth);
    }

    protected function authUser(User $user): ?TokenItem
    {
        return $this->authUserRepo->fetchById($user);
    }

    abstract public function requestType(): string;
}