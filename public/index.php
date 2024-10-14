<?php
session_start();
?>
<htmL lang="fr">
<head><title>Benveniidoo !</title></head>
<body>
<?php
    if(empty($_SESSION['token'])) {
        ?><a href="coupleWithSpotify">Associer le site à votre compte Spotify</a><br/><?php
    } else {
        echo "Votre compte Spotify a été correctement associé, félicitations !", "<br/>";
        ?><a href="forgetMySpotify">Oublier mon compte</a><br/>
        <a href="playlistsMosaic">Afficher mes playlists</a>
        <?php
    }
?>
<br/>
<!--script type="module">
    // Authorization token that must have been created previously. See : https://developer.spotify.com/documentation/web-api/concepts/authorization
    const token = 'BQBYPY5gTGfxhcDzvPe_-zdw1p4lpyXMHOfbiHkrferXDQQ6VTN-EkYC-vcm8N3E-TgsAZH7i2kUPBRaafaFnIg9UJChFARUOratt7Qln6XjWVazpTg';
    async function fetchWebApi(endpoint, method, body) {
        const res = await fetch(`https://api.spotify.com/${endpoint}`, {
            headers: {
                Authorization: `Bearer ${token}`,
            },
            method,
            body:JSON.stringify(body)
        });
        return await res.json();
    }

    async function getTopTracks(){
        // Endpoint reference : https://developer.spotify.com/documentation/web-api/reference/get-users-top-artists-and-tracks
        return (await fetchWebApi(
            'v1/me/top/tracks?time_range=long_term&limit=5', 'GET'
        )).items;
    }

    const topTracks = await getTopTracks();
    console.log(
        topTracks?.map(
            ({name, artists}) =>
                `${name} by ${artists.map(artist => artist.name).join(', ')}`
        )
    );
</script-->

</body>
</htmL>
