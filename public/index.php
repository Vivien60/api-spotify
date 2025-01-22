<?php
declare(strict_types=1);
require_once "../src/autoload.php";
session_start();
/**@TODO Vivien: http error mapper api. Exemple :
 *      class ServiceAErrorMapper {
 *          public static function mapError($response) {
 *              switch ($response->statusCode) {
 *                  case 401:
 *                      throw new RequestAuthError("Authentication failed in Service A.");
 *                  case 404:
 *                      throw new NotFoundError("Resource not found in Service A.");
 *                  case 500:
 *                      throw new ServiceAInternalError("Internal server error in Service A.");
 *                  default:
 *                      throw new GeneralHttpError("Unexpected error from Service A.");
 *              }
 *          }
 *      }
 */

/** @TODO Vivien:
 *      Il faudra faire en sorte qu'un utilisateur puisse être associé à plusieurs authentifications externes
 */


/** @TODO Vivien:
 *      Inverser ConfigDispatch : il faut pouvoir l'initialiser avec une conf dans le code client, et ce sont les objets qu'on lui passe.
 *      Car là, on doit le modifier à chaque fois qu'une classe a besoin de config, il est couplé à beaucoup de classes.
 *      Il vaudrait mieux que ce soit les classes qui l'appellent, je pense,
 *      en passant par ConfigDispatcher ou un système similaire, qui renvoie la conf initialisée.
 */

/** @TODO Vivien:
 *      voir pour mettre en place des values objects : immutable objects qui renvoient une nouvelle instance
 *      en cas de modification (via des méthodes withXXX)
 */

?>
<html lang="fr">
<head><title>Benveniidoo !</title></head>
<body>
<?php
    if(empty($_SESSION['token'])) {
        ?><a href="coupleWithMusicService">Associer le site à votre compte Spotify</a><br/><?php
    } else {
        echo "Votre compte Spotify a été correctement associé, félicitations !", "<br/>";
        ?><a href="forgetMySpotify">Oublier mon compte</a><br/>
        <a href="playlistsMosaic">Afficher mes playlists</a>
        <?php
    }
?>
<br/>
</body>
</html>
