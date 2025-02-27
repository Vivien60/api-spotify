<?php
declare(strict_types=1);
require_once "../src/autoload.php";
require_once "../src/utils/trace.php";

use config\Config;
use GuzzleHttp\Exception\RequestException;
use apispotify\service\ConfigDispatcher;

session_start();
ConfigDispatcher::dispatch(Config::getInstance());
error_reporting(E_ALL);
if (!empty($_GET['code']) && !empty($_GET['state'])) {
    try {
        $service = new \service\OAuthService();
        $service->createUserToken(
            htmlentities($_GET['code']),
            ['state' => htmlentities($_GET['state'])],
            Config::getInstance()->playlistService,
        );
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