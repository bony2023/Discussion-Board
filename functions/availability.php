<?php
 	function useravail($u) {
	$sql="SELECT * from users where uname='$u'";
	$res=mysql_query($sql);
	if(mysql_num_rows($res)==1)
		return false;
	else
		return true;
	}
?>