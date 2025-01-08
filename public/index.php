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

?>
<htmL lang="fr">
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
</htmL>
