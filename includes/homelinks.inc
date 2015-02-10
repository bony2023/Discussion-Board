<?php
	require_once('includes/topic_datalist.inc');
	$uname=$_SESSION['uname'];
	$res=@mysql_query("SELECT * from users where uname='$uname'");
	$res=mysql_fetch_array($res);
	$pic=0;
	if($res['userpicture'])
		$pic="profile_images/$uname.jpg";
	else
		$pic="images/user.jpg";
	
	$uname=$_SESSION['uname'];
	$sql="SELECT * from `messages` where `status_to`=1 and `to`='$uname'";
	$res=@mysql_query($sql);
	$pending=mysql_num_rows($res);
?>
<div class="homelinks" align="center">
	<link href="css/main.css" type="text/css" rel="stylesheet"/>
    <br>
    <a href="home.php">Home</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="profile.php"><img src="<?php echo $pic; ?>" width="20" height="20"/> Profile (<?php echo $uname; ?>)</a> 
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="messages.php">Messages <?php if($pending) echo '('.$pending.')'; ?></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="settings.php">Settings</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="logout.php">Logout</a>
</div>

<div class="search">
	<form action="" method="post">
	<table>
    	<tr>
        	<td><b>Add Topics</b></td> <td> <input type="text" list="topics" name="choose"/> </td> <td> <input type="submit" value="Add" name="add"/> </td>
        </tr>
    </table>
    </form>
    <?php
		if(isset($_POST['add'])) {
			$topic=$_POST['choose'];
			$topic[0]=strtolower($topic[0]);
			@mysql_query("UPDATE `topics` SET `$topic`='1' where `uname`='$uname'");
		}
	?>
</div>
<br> 
<div class="content">
    <label class="trend">
        <fieldset>
            <legend align="left"><h3>Your Topics</h3></legend>
            <?php
				require_once('functions/main.php');
				$topics=get_topics($uname);
				for($i=0; $i<sizeof($topics); $i++) {
					$topic=$topics[$i];
					$topic[0]=strtolower($topic[0]);
					echo "<a href='listposts.php?topic=$topic'>$topics[$i]</a><br>";
				}
			?>
        </fieldset>
    </label>
</div>
<div class="pad">
	<p style="margin-top: -120px;"><a href="newpost.php"><img src="images/pin.png" width="20" height="20"/> <b>New Post</b></a></p>
</div>