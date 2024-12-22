<?php
require_once "../src/autoload.php";

use GuzzleHttp\Exception\RequestException;
use infrastructure\dal\api\Spotify\client\ClientForToken as Client;
use infrastructure\dal\api\Spotify\request\TokenFromCode;
use model\Credentials\BusinessLogic\CredentialsRepo;
use model\Credentials\Persistence\OneFileAdapter;

session_start();
require_once "../src/utils/trace.php";
require_once "../config/Config.php";

/**
 * @TODO Vivien : gestion de l'affichage de l'erreur
 */
const STATE_OK = 1;
$storageFile = dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'token.json';

if (!empty($_GET['code']) && !empty($_GET['state']) /*&& $_GET['state'] == STATE_OK*/) {
    try {
        /**
         * @TODO Vivien :
         *              Voir pour passer par un adapter, puisque Client fait appel à une infra externe.
         *              Ici on est dans un process de couplage avec un service externe, donc peut être OAuth.
         */
        $client = new Client();
        $tokenRequest = new TokenFromCode(CLIENT_ID, CLIENT_SECRET, htmlentities($_GET['code']), REDIRECT_URI);
        $response = $client->sendRequest($tokenRequest);
        $token = json_decode($response->getBody());
        if($token?->access_token) {
            $repo = new CredentialsRepo(new OneFileAdapter($storageFile));
            $repo->saveNewOne($token);
        } else {
            throw new \exception\AuthError("There was an error while sending token request");
        }
    } catch (RequestException $e) {
        /**
         * @TODO Vivien :
         *      Voir pour retirer ce cas.
         *      Normalement à ce niveau tout devrait être géré par des Exceptions "fonctionnelles".
         */
        traceRequestException($e, "There was an error while sending token request : " . $e->getMessage());
    } catch (Throwable|Exception $e) {
        traceException($e, "There was an error while sending token request : " . $e->getMessage());
    }
}

header('Location: index.php');