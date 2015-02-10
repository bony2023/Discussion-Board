<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Recover Account</title>
<link href="css/main.css" type="text/css" rel="stylesheet"/>
<?php
	require_once('includes/db.inc');
	require_once('includes/topic_datalist.inc');
?>
</head>

<body>
	<?php
		require_once("includes/header.inc");
	?>
	<form class="login" action="" method="post">
    	<fieldset>
        	<legend align="center"><h2>Recover account</h2></legend>
            <table align="center">
            	<tr>
                	<td><h4>Email:</h4></td> <td><input type="email" name="email" required/></td>
                </tr>
                <tr>
                	<td><h4>Mention any two of your favourite topics:</h4></td>
                    <td><input type="text" list="topics" name="fav1" required/></td>
                </tr>
                <tr>
                	<td></td><td><input type="text" list="topics" name="fav2" required/></td>
                </tr>
                <tr>
                	<td align="center" colspan="3" height="50"><input type="submit" name="recover" value="Recover"/></td>
                </tr>
            </table>
            <?php
				if(isset($_POST['recover'])) {
					$e=$_POST['email'];
					$one=$_POST['fav1']; $one=strtolower($one);
					$two=$_POST['fav2']; $two=strtolower($two);
					if(true) {
						$tempres=mysql_query("SHOW COLUMNS from topics LIKE '$one'");
						if(!mysql_num_rows($tempres)) {
							echo '<p align="center">'.$one.' topic not found.</p>';
							exit(1);
						}
						$tempres=mysql_query("SHOW COLUMNS from topics LIKE '$two'");
						if(!mysql_num_rows($tempres)) {
							echo '<p align="center">'.$two.' topic not found.</p>';
							exit(1);
						}
					}
					
					{
						$tempres=mysql_query("SELECT uname from users where email='$e'");
				 		if(!mysql_num_rows($tempres)) 
							echo '<p align="center">Email not found.</p>';
						else {
							$tempres=mysql_fetch_array($tempres);
							$user_id=$tempres['uname'];
							$sql="SELECT users.pwd from users, topics where (users.uname='$user_id' and topics.uname='$user_id' and topics.$one=1 and topics.$two=1)";
							$res=mysql_query($sql);
							if(!mysql_num_rows($res)) {
								echo '<p align="center">Wrong details entered.</p>';
								exit(1);
							}
							else if($res) {
								$pwd=mysql_fetch_array($res);
								$pwd=$pwd['pwd'];
								echo '<p align="center"><b>Account Recovered</b> <br> Username: '.$user_id.'<br>Password: '.$pwd.'<br><br> <a href="index.php">Login</a> </p>';
							}
							else
								echo '<p align="center">Wrong details entered.</p>';
						}
					}
				}
			?>
        </fieldset>
    </form>
    <?php
		require_once("includes/footer.inc");
	?>
</body>
</html>