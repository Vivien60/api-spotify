<?php
require_once "../src/autoload.php";
require_once "../src/utils/trace.php";

use config\Config;
use GuzzleHttp\Exception\RequestException;
use service\ConfigDispatcher;
use service\GetUserToken;

session_start();
ConfigDispatcher::dispatch(Config::getInstance());
/**
 * @TODO Vivien : gestion de l'affichage de l'erreur
 */
const STATE_OK = 1;

if (!empty($_GET['code']) && !empty($_GET['state']) /*&& $_GET['state'] == STATE_OK*/) {
    try {
        $service = new GetUserToken();
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