<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Messages</title>
<link href="css/main.css" type="text/css" rel="stylesheet"/>
<?php
	require_once('functions/main.php');
	require_once('includes/db.inc');
	session_start();
	$uname=$_SESSION['uname'];
?>
<?php
	if(isset($_GET['mark'])) {
		$id=$_GET['id'];
		if($_GET['mark']=='read') {
			$sql="UPDATE `messages` SET `status_to`='0' where `m_id`='$id'";
			@mysql_query($sql);
		}
		else {
			$sql="UPDATE `messages` SET `status_to`='1' where `m_id`='$id'";
			@mysql_query($sql);
		}
	}
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
    <div class="profile" align="center">
    	<fieldset class="pp">
        	<legend align="center"><h3>All Messages</h3></legend>
            <?php
				$sql="SELECT * from `messages` where (`from`='$uname' or `to`='$uname')";
				$res=@mysql_query($sql);
				$line=false;
				while(list($from, $to, $id, $status_from, $status_to)=mysql_fetch_array($res)) {
					if($line) echo "<br><br><br>";
			?>
            <table align="center">
				<tr>
                	<td><?php if($to==$uname and $status_to==1) echo "<b><a href='profile.php?member=$from'>$from</a> to <a href='profile.php?member=$to'>$to</a></b>"; else echo "<a href='profile.php?member=$from'>$from</a> to <a href='profile.php?member=$to'>$to</a>"; ?>
                    <td><?php if($to==$uname and $status_to==1) echo "<a class='mark' href='?mark=read&id=$id'>Mark as read</a>"; else echo "<a class='mark' href='?mark=unread&id=$id'>Mark as unread</a>"; ?></td>
                    <td>
                    	<?php
							$reply="";
							if($from==$uname) $reply=$to;
							else $reply=$from;
							echo "<a class='mark' href='sendmessage.php?to=$reply'>Reply</a>";
						?>
                    </td>
                </tr>
                <tr>
                	<td><?php $fp=fopen("conversations/$id.txt", "r"); echo fread($fp, filesize("conversations/$id.txt")); ?></td>
                </tr>
            </table>
            <?php
				$line=true;
				}
			?>
        </fieldset>
    </div>
    <?php
    	require_once("includes/footer.inc");
	?>
</body>
</html>