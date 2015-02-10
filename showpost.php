<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php
	$id=$_GET['id'];
	$fp=@fopen("posts/$id.txt", "r");
	$title=@fread($fp, filesize("posts/$id.txt"));
	$fp=@fopen("description/$id.txt", "r");
	$post=@fread($fp, filesize("description/$id.txt"));
?>
<title><?php echo $title; ?></title>
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
    	<h3 style="margin-left: -80px; margin-top: -40px;"><?php echo $title; ?></h3>
       	<i><p style="margin-left: -80px; margin-right: 380px;"><?php echo $post; ?></p></i>
        <a style="margin-left: -80px;" href="reply.php?id=<?php echo $id ?>&root=<?php echo $id; ?>"><img src="images/reply.png" width="15" height="15"/>Reply to post</a>
        <br> <br> <br>   
        <fieldset style="margin-left: -80px;">
        	<div style="padding: 20px;">
        		<?php
					$currid=$_GET['id'];
					display_all_replies($currid, $currid, 0, true, $pic);
				?>
        	</div>
        </fieldset>
    </div>
    <?php
		require_once('includes/footer.inc');
	?>
</body>
</html>