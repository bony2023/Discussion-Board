<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Home</title>
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
    <div style="margin-top: -100px; margin-left: 150px;">
    	<?php
			$topics=get_topics($uname);
			$ids=array();
			for($i=0; $i<sizeof($topics); $i++) {
				$topic=$topics[$i];
				$sql="SELECT `post_id` from `posts` where `topic`='$topic'";
				$res=mysql_query($sql);
				while($id=mysql_fetch_array($res)) {
					$ids[]=$id['post_id'];
				}
			}
			sort($ids);
			if(!sizeof($ids)) {
				echo "<h3 align='center'>No posts to display!</h3>";
			}
			for($i=0; $i<sizeof($ids); $i++) {
				$id=$ids[$i];
				$fp=fopen("posts/$id.txt", "r");
				$post_title=fread($fp, filesize("posts/$id.txt"));
				$sql="SELECT `by`, `topic` from `posts` where `post_id`='$id'";
				$res=mysql_query($sql);
				$res=mysql_fetch_array($res);
				$by=$res['by'];
				$topic=$res['topic'];
				$ttopic=$topic;
				$topic[0]=strtoupper($topic[0]);
				echo "<h3 style='display: inline;'><a href='showpost.php?id=$id'><b>$post_title</a></h3> - <a href='listposts.php?topic=$ttopic'><i>$topic</i></b></a><br><br><img src='images/view.png' width='20' height='20'/><a href='showpost.php?id=$id'>View Post</a><br><br><img src='images/reply.png' width='15' height='15'/><a href='reply.php?id=$id&root=$id'>Reply Post</a><hr style='margin-left: -50px;'> <br><br>";
			}
		?>
    </div>
   	<?php
    	require_once("includes/footer.inc");
	?>
</body>
</html>