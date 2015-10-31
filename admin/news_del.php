<?php
 	require_once("admin-header.php");
 	require_once("../include/check_get_key.php");
 	$sql="delete FROM `news` WHERE `news_id`={$_GET['id']}";
    mysql_query($sql) or die(mysql_error());   
 ?>
 <script language=javascript>
 	alert("删除成功！");
    window.location.href='news_list.php';
 </script>
