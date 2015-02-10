<?php
	require_once('functions/main.php');
	session_start();
	destroy_session();
	setcookie("user", "", time()+0, "/");
	sleep(1);
	header('Location: index.php');
?>