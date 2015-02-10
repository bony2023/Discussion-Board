<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Settings</title>
<link href="css/main.css" type="text/css" rel="stylesheet"/>
<?php
	require_once('functions/main.php');
	require_once('includes/db.inc');
	session_start();
?>
</head>

<body>
	<?php
		require_once('includes/header.inc');
	?>
    <?php
		if($_SESSION['isopen'])
			require_once("includes/homelinks.inc");
		else {
			sleep(1);
			header('Location: index.php');
		}
	?>
    <div align="center">
    	<form action="" method="post">
        	<input type="submit" value="Delete my account" name="del"/>
        </form>
        <?php
			if(isset($_POST['del'])) {
				?>
                <form action="includes/delete.php" method="post">
                	<p align="center"><b>Are you sure you want to delete your account? This can't be undone.</b></p>
                    <br>
                    <input type="submit" value="Yes! Delete my account" name="yes"/> <br><br>
                    <input type="submit" value="No! I choose to be funchayat's member" name="no"/>
                </form>
                <?php
			}
		?>
    	<a href="editprofile.php"><h3>Edit Profile</h3></a>
    </div>
    <?php
		require_once('includes/footer.inc');
	?>
</body>
</html>