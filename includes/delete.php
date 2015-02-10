<?php
	require_once('db.inc');
	require_once('../functions/main.php');
	session_start();
	$uname=$_SESSION['uname'];
	if(isset($_POST['yes'])) {
		@mysql_query("DELETE from users where uname='$uname'");
		@mysql_query("DELETE from topics where uname='$uname'");
		unlink("../profile_images/$uname.jpg");
		destroy_session();
		sleep(1);
		header('Location: ../index.php');
	}
	else if(isset($_POST['no'])) {
		header('Location: ../settings.php');
	}
?>