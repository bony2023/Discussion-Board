<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Reply to post</title>
<link href="css/main.css" type="text/css" rel="stylesheet"/>
<?php
	require_once('functions/main.php');
	require_once('includes/db.inc');
	session_start();
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
    <div class="pad" align="center">
    	<form style="margin-left: 0px; margin-top: -100px;" action="" method="post">
        	<textarea style="width:595px; height: 300px;" placeholder="Reply to post" name="rep"></textarea> <br>
            <input style="width: 100px; height:30px;" type="submit" name="reply" value="Reply"/>
        </form>
        <?php
			if(isset($_POST['reply'])) {
				$post_id=$_GET['id'];
				$root=$_GET['root'];
				$sql="SELECT * from `replies` where `post_id`='$post_id'";
				$res=mysql_query($sql);
				$rep_id=mysql_num_rows($res)+1;
				$sql="SELECT * from `replies`";
				$res=mysql_query($sql);
				$sn=mysql_num_rows($res);
				$sql="INSERT into `replies`(`serial`, `post_id`, `rep_id`, `root`, `by`) values('$sn','$post_id', '$rep_id', '$root', '$uname')";
				mysql_query($sql);
				$reply=$_POST['rep'];
				$fp=fopen("replies/$post_id/$rep_id.txt", "w");
				fwrite($fp, $reply);
				fclose($fp);
				echo "<script>location.href='showpost.php?id=$post_id';</script>";
			}
		?>
    </div>
    <?php
		require_once('includes/footer.inc');
	?>
</body>
</html>