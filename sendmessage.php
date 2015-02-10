<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Send message to <?php echo $_GET['to']; ?></title>
<link href="css/main.css" type="text/css" rel="stylesheet"/>
<?php
	session_start();
	if($_SESSION['uname']==$_GET['to']) {
		sleep(1);
		header('Location: profile.php');
	}
	require_once('functions/main.php');
	require_once('includes/db.inc');
?>
</head>

<body>
	<?php
		require_once("includes/header.inc");
	?>
    <?php
		if($_SESSION['isopen'])
			require_once("includes/homelinks.inc");
		else {
			sleep(1);
			header('Location: index.php');
		}
	?>
    <div class="profile" align="left">
    	<h2 align="center"><a href="messages.php">See all Messages</a></h2>
    	<h3>Send message to <?php echo $_GET['to']; ?></h3>
        <form action="" method="post">
    		<textarea placeholder="Enter your message here" name="message"></textarea> <br> <input type="submit" value="Send" name="send"/>
        </form>
        <?php
			if(isset($_POST['send'])) {
				$from=$_SESSION['uname'];
				$to=$_GET['to'];
				$message=$_POST['message'];
				$sql="SELECT * from messages";
				$id=mysql_num_rows(@mysql_query($sql))+1;
				$sql="INSERT into `messages`(`from`, `to`, `m_id`, `status_from`, `status_to`) values('$from', '$to', '$id', '0', '1')";
				@mysql_query($sql);
				$fp=fopen("conversations/$id.txt", "w");
				fwrite($fp, $message);
				fclose($fp);
				header('Location: messages.php');
			}
		?>
    </div>
    <?php
		require_once("includes/footer.inc");
	?>
</body>
</html>