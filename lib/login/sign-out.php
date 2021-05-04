<?php
session_start();
if (isset($_SESSION["user"])) {
	session_destroy();
	header("Location: sign-in.html");
} else {
	echo "Acess denied";
}
?>