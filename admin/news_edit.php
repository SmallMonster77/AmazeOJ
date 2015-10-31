<?php 
	$title="修改公告";
	require_once ("admin-header.php");
	require_once ("admin-main.php");
?>
<?php require_once("../include/db_info.inc.php");
if (isset($_POST['news_id']))
{
	require_once("../include/check_post_key.php");
$title = $_POST ['title'];
$content = $_POST ['content'];
$user_id=$_SESSION['user_id'];
$news_id=intval($_POST['news_id']);
if (get_magic_quotes_gpc ()) {
	$title = stripslashes ( $title);
	$content = stripslashes ( $content );
}
$title=mysql_real_escape_string($title);
$content=mysql_real_escape_string($content);
$user_id=mysql_real_escape_string($user_id);

	$sql="UPDATE `news` set `title`='$title',`time`=now(),`content`='$content',user_id='$user_id' WHERE `news_id`=$news_id";
	//echo $sql;
	mysql_query($sql) or die(mysql_error());
	echo "<script>window.alert('修改成功！');window.location.href='news_list.php';</script>";
}else{
	$news_id=intval($_GET['id']);
	$sql="SELECT * FROM `news` WHERE `news_id`=$news_id";
	$result=mysql_query($sql);
	if (mysql_num_rows($result)!=1){
		mysql_free_result($result);
		echo "No such Contest!";
		exit(0);
	}
	$row=mysql_fetch_assoc($result);
	
	$title=htmlspecialchars($row['title']);
	$content=$row['content'];
	mysql_free_result($result);
		
}
?>
<div class="admin-content">
	<div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">添加公告</strong></div>
    </div>
    <hr />
    <div class="am-container">
    	<form class="am-form am-form-horizontal" action="news_edit.php" method="post">
	    	<div class="am-form-group">
	    		<label for="doc-ipt-3" class="am-u-sm-2 am-form-label">标题</label>
			    <div class="am-u-sm-10">
			      <input type="text" id="doc-ipt-3" placeholder="请输入一个标题" name=title value='<?php echo $title?>'>
			      <input type=hidden name='news_id' value=<?php echo $news_id?>>
			    </div>
	    	</div>
	    	<div class="am-form-group">
	    		<label for="doc-ipt-2" class="am-u-sm-2 am-form-label">内容</label>
			    <div class="am-u-sm-10">
			    <?php
				include_once("../fckeditor/fckeditor.php") ;
				$description = new FCKeditor('content') ;
				$description->BasePath = '../fckeditor/' ;
				$description->Height = 450 ;
				$description->Width=800;
				$description->Value = $content ;
				$description->Create() ;
				?>
			    </div>
	    	</div>
	    	<?php require_once("../include/set_post_key.php");?>
	    	<div class="am-form-group">
	    		<div class="am-u-sm-10 am-u-sm-offset-2">
	    			<input type=submit value=更新 name=submit class="am-btn am-btn-success">
	    		</div>		
	    	</div>
			
		</form>
    </div>
</div>
<?php require_once ("admin-footer.php");?>
