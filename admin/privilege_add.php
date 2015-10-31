<?php 
	require_once("admin-header.php");
	if(isset($_POST['do'])){
		//require_once("../include/check_post_key.php");
		$user_id=mysql_real_escape_string($_POST['user_id']);
		//$rightstr =$_POST['rightstr'];
		$sql="insert into `privilege` values('$user_id','administrator','N')";
		mysql_query($sql);
		//if (mysql_affected_rows()==1) echo "$user_id $rightstr added!";
		if (mysql_affected_rows()==1) echo "<script language=javascript>alert('ok!');history.go(-1);</script>";
		else echo "<script language=javascript>alert('error!');history.go(-1);</script>";
	}
	else{
		echo "<script language=javascript>alert('aaaa');history.go(-1);</script>";
	}
?>
