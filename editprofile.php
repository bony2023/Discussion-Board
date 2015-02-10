<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edit profile: <?php session_start(); echo $_SESSION['uname'];  ?></title>
<link href="css/main.css" type="text/css" rel="stylesheet"/>
<?php
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
    	<?php
			$u=$_SESSION['uname'];
			$sql="SELECT * from users where uname='$u'";
			$res=mysql_query($sql);
			$res=mysql_fetch_array($res);
			$sql="SELECT * from topics where uname='$u'";
			$topic=mysql_query($sql);
			$topic=mysql_fetch_array($topic);
		?>
        <fieldset class="pad">
        	<legend><h3>Edit Profile</h3></legend>
        	<form action="" method="post" enctype="multipart/form-data">
            	<table>
                	<tr>
                    	<?php
							$pic=0;
							if($res['userpicture'])
								$pic="profile_images/$u.jpg";
							else
								$pic="images/user.jpg";
						?>
                        <td> <img src="<?php echo $pic; ?>" width="128" height="128"/> </td>
                    </tr>
                </table>
                <table>
                    <tr>
                    	<td>Change display picture: </td> <td><input type="file" name="userpic" id="userpic"/></td>
                    </tr>
                </table>
                <br><br>
                <table align="center">
                	<tr>
                    	<td><h4>Email: </h4></td> <td><input type="email" value="<?php echo $res['email']; ?>" name='email'/></td>
                    </tr>
                    <tr>
                    	<td><h4>Birthday: </h4></td> <td><input type="date" value="<?php echo $res['dob']; ?>" name='dob'/> </td>
                    </tr>
                    <tr>
                    	<td><h4>Old Password: </h4></td> <td><input type="password" name="opwd"/></td>
                    </tr>
                    <tr>
                    	<td><h4>New Password: </h4></td> <td><input type="password" name="npwd"/></td>
                    </tr>
                    <tr>
                    	<td><h4>Confirm new Password: </h4></td> <td><input type="password" name="cnpwd"/></td>
                    </tr>
                    <tr>
                    	<td></td><td><input type="submit" name="saveprofile" value="Save"/></td>
                    </tr>
                </table>
                <br><br><br>
                <table align="center">
                    <tr>
                    	<td><b>Leave the field(s) blank if no change has to be done.</b></td>
                    </tr>
                </table>
            </form>
            <?php
				if(isset($_POST['saveprofile'])) {
					$p=@getimagesize($_FILES['userpic']['tmp_name']);
					if($p) {
						@unlink("profile_images/$u.jpg");
						@mysql_query("UPDATE users SET userpicture=1 where uname='$u'");
						@move_uploaded_file($_FILES['userpic']['tmp_name'], "profile_images/$u.jpg");
					}
					$e=$_POST['email'];
					@mysql_query("UPDATE users SET email='$e' where uname='$u'");
					$dob=$_POST['dob'];
					@mysql_query("UPDATE users SET dob='$dob' where uname='$u'");
					$pwd=$_POST['opwd'];
					if($pwd != '') {
						if($pwd != $res['pwd']) {
							echo '<p align="center">Old password is wrong.</p>';
							exit(0);
						}
						$npwd=$_POST['npwd'];
						$cnpwd=$_POST['cnpwd'];
						if($npwd != $cnpwd) {
							echo '<p align="center">Passwords do not match.</p>';
							exit(0);
						}
						@mysql_query("UPDATE users SET pwd='$npwd' where uname='$u'");
					}
					echo '<p align="center">Changes Saved.</p>';
					sleep(1);
					header('Location: profile.php');
				}
			?>
        </fieldset>
    </div>
    <?php
		require_once("includes/footer.inc");
	?>
</body>
</html>