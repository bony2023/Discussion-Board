<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add Post</title>
<link href="css/main.css" type="text/css" rel="stylesheet"/>
<?php
	require_once('includes/topic_datalist.inc');
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
    	<p style="margin-top:-120px;"><h3>Add a new post</h3></p>
    	<form style="margin-left: 40px; margin-top: 40px;" action="" method="post">
        	<input style="height: 40px; width: 400px;" type="text" name="p_name" placeholder="Post Name" required/> <b>in</b> 
            <input style="height: 40px;" type="text" list="topics" name="p_topic" placeholder="Topic" required/> <br> <br>
            <textarea style="width:595px; height: 300px;" placeholder="Description about the post" name="p_des"></textarea> <br>
            <input style="width: 100px; height:30px; margin-left:-150px;" type="submit" name="post" value="POST"/>
        </form>
        <?php
			if(isset($_POST['post'])) {
				$post_name=$_POST['p_name'];
				$topic=$_POST['p_topic'];
				$topic[0]=strtolower($topic[0]);
				$des=$_POST['p_des'];
				$sql="SELECT * from `posts`";
				$res=mysql_query($sql);
				$id=mysql_num_rows($res);
				$sql="SELECT * from `replies`";
				$res=mysql_query($sql);
				$id+=(mysql_num_rows($res));
				$sql="INSERT into `posts`(`post_id`, `topic`, `by`) values('$id', '$topic', '$uname')";
				mysql_query($sql);
				$fp=fopen("posts/$id.txt", "w");
				fwrite($fp, $post_name);
				fclose($fp);
				$fp=fopen("description/$id.txt", "w");
				fwrite($fp, $des);
				fclose($fp);
				$sql="UPDATE `topics` SET `$topic`='1' where `uname`='$uname'";
				mysql_query($sql);
				mkdir("replies/$id");
				sleep(1);
				echo("<script>location.href='home.php';</script>");
			}
		?>
    </div>
    <?php
		require_once('includes/footer.inc');
	?>
</body>
</html>