<?php
    require_once('admin-header.php');
	require_once("../include/check_post_key.php");
	require_once("../include/my_func.inc.php");
	$user_name=$_POST['user_name'];
	
	$pwd=$_POST['npassword'];
	$len=strlen($pwd);
	if($len>0&&$len<6){
		echo "<script>alert('密码格式不对!');history.go(-1);</script>";
		exit(0);
	}
	$sql="select * from users where user_id='{$_POST['user_name']}'";
	$res=mysql_query($sql);
	if(mysql_num_rows($res) < 1){
		echo "<script>alert('不存在此用户!');history.go(-1);</script>";
		exit(0);
	}
	$pwd=pwGen($_POST['npassword']);
	$sql="UPDATE users SET password='$pwd' where user_id='".mysql_real_escape_string($user_name)."'";
	mysql_query($sql);// or die("Insert Error!\n");
	echo "<script language=javascript>window.alert('ok!');history.go(-1);</script>";
?>