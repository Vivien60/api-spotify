<?php
session_start();
if(empty($_SESSION["token"])){
    die("Not allowed");
}
session_destroy();
header('location:index.php');