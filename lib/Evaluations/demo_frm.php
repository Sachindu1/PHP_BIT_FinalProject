<?php


$to = "madura@localhost";
$subject = "test php mail";
$body = "madura sucks!";
$headers = "From: sachindu@localhost \n\r";
// $header = "MIME-Version: 100 Content-Type:text/html \n\r"
mail($to,$subject,$body,$headers);


 ?>
