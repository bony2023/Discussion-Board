<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Profile</title>
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
    <div class="profile" align="left">
    	<?php
			$my=true;
			if(isset($_GET['member']) and $_GET['member'] != $_SESSION['uname']) {
				$my=false;
				$u=$_GET['member'];
				$sql="SELECT * from users where uname='$u'";
				$res=mysql_query($sql);
				$res=mysql_fetch_array($res);
				$sql="SELECT * from topics where uname='$u'";
				$topic=mysql_query($sql);
				$topic=mysql_fetch_array($topic);
			}
			else {
				$u=$_SESSION['uname'];
				$sql="SELECT * from users where uname='$u'";
				$res=mysql_query($sql);
				$res=mysql_fetch_array($res);
				$sql="SELECT * from topics where uname='$u'";
				$topic=mysql_query($sql);
				$topic=mysql_fetch_array($topic);
			}
		?>
    	<fieldset class="pad">
    		<table>
            	<tr>
                	<?php
						$pic=0;
						if($res['userpicture'])
							$pic="profile_images/$u.jpg";
						else
							$pic="images/user.jpg";
					?>
                	<td> <img src="<?php echo $pic; ?>" width="128" height="128"/> </td> <td></td> <td> <h2><?php echo $res['uname']; ?> </h2> </td>
                </tr>
             </table>
             <table>
             	<tr>
                	<?php
						if($my)
                			echo '<td><a href="editprofile.php"><h3>Edit Profile</h3></a></td>';
						else
                    		echo '<td><a href="sendmessage.php?to='.$u.'"><h3>Message User</h3></a></td>';
					?>
                </tr>
             </table>
             <table align="center">
                <tr>
                	<td><b>Email: </b></td> <td></td> <td></td> <td> <i><h3><?php echo $res['email']; ?></h3></i> </td>
                </tr>
                <tr>
                	<td><b>Birthday: </b></td><td></td> <td></td> <td> <i><h3><?php echo $res['dob']; ?> </h3></i> </td>
                </tr>
                <tr>
                	<td><b>Topics of interest: </b></td><td></td> <td></td> <td> <i><h3><?php $topics=get_topics($u); for($i=0; $i<sizeof($topics); $i++) {
					echo "$topics[$i]<br>";
				} ?> </h3></i> </td>
                </tr>
            </table>
        </fieldset>
    </div>
   	<?php
    	require_once("includes/footer.inc");
	?>
</body>
</html>