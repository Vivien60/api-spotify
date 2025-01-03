<?php
require_once "../src/autoload.php";
session_start();
var_dump($_SESSION);
/**@TODO Vivien: http error mapper api. Exemple :
 *      class ServiceAErrorMapper {
 *          public static function mapError($response) {
 *              switch ($response->statusCode) {
 *                  case 401:
 *                      throw new AuthError("Authentication failed in Service A.");
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
/**@TODO Vivien: Externalisation de la configuration :
 *      Externalisation de la configuration dans des fichiers JSON, YAML ou une base de données
 *      pour faciliter la gestion et les modifications des paramètres sans toucher au code.
 */
/**@TODO Vivien: Amélioration de la gestion des sessions et des tokens :
 *      Vérification de la validité des tokens avant chaque utilisation
 *      et implémentation d'un mécanisme de rafraîchissement automatique des tokens expirés.
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
