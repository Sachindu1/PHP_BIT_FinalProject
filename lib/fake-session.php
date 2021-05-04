<?php
session_start();
$_SESSION["user"]["uname"]="Sachindu";
$_SESSION["user"]["utype"]="1";
$_SESSION["user"]["umail"]="abc@mail.com";
$_SESSION["user"]["id"] = 6;
header("Location:../lib")

?>

