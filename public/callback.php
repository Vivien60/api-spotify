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

if (!empty($_GET['code']) && !empty($_GET['state']) /*&& $_GET['state'] == STATE_OK*/) {
    try {
        $service = new Service\GetUserToken();
        $token = $service->createUserToken(htmlentities($_GET['code']));
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