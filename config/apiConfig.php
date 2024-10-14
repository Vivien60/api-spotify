<?php
const API_BASE_URL = 'https://api.spotify.com/v1/';
const TOKEN_BASE_URL = 'https://accounts.spotify.com/';
const CLIENT_ID = '___';
const CLIENT_SECRET = '____';
const REDIRECT_URI = '____';
const SCOPE = 'user-library-modify app-remote-control playlist-modify-private playlist-modify-public playlist-read-collaborative playlist-read-private streaming user-follow-read user-library-read user-modify-playback-state user-read-currently-playing user-read-email user-read-playback-position user-read-playback-state user-read-private user-read-recently-played user-top-read';
const LYRICS_API_BASE_URL = 'https://api.lyrics.ovh/v1/';
define('TOKEN_STORAGE_FILE', dirname(__FILE__,2).DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'token.json');