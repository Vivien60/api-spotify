1ère version d'un module permettant la récupération des playlists d'un utilisateur sur Spotify (avec son autorisation, via un process OAuth), et la récupération des paroles via LyricsOVH.
Avec architecture donnant la possibilité d'ajouter des APIs, ou de sauvegarder le token d'accès différemment, simpleement en ajoutant des classes.
Le code se situe dans le dossier src/, avec les dépendances via composer à la racine du projet (composer.json).
Le dossier public sert lui d'exemple de code utilisateur.
Me demander pour installer la conf du projet. Elle n'est pas incluse car il y a des api-key.
Pensez à faire un composer install pour inclure les librairies manquantes !

Il reste à faire de petites choses, notamment :
- peut-être créer un adapteur qui fera appels aux adapteurs Lyrics et Song, le code utilisateur n'ayant aucune raison de savoir qu'il y a 2 apis différentes pour récupérer les chansons de l'utilisateur et afficher les paroles.
- proposer un moyen d'éviter de faire des requêtes directement, notamment pour le process OAuth... Peut-être un OAUthCLientdans ma couche "persistenceclient" ?
- vérifier si on peut parler d'architecture hexagonale pour mon modèle, je m'en suis inspiré.