<?php 
	$title="题目管理";
	require_once("admin-header.php");
	require_once("admin-main.php");
	
?>
<div class="admin-content">
	<div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">找回密码</strong></div>
    </div>
	<hr />
	<div class="am-container">
		<form class="am-form am-form-horizontal" action="change_password.php" method="post">
			<div class="am-form-group">
				<label for="doc-ipt-1" class="am-u-sm-2 am-form-label">用户名：</label>
			    <div class="am-u-sm-10">
			      <input type="text" id="doc-ipt-1" placeholder="用户名" name="user_name">
			      <?php require_once("../include/set_post_key.php"); ?>
			    </div>
			</div>
			<div class="am-form-group">
				<label for="doc-ipt-2" class="am-u-sm-2 am-form-label">新密码：</label>
			    <div class="am-u-sm-10">
			      <input type="text" id="doc-ipt-2" placeholder="新密码" name="npassword">
			    </div>
			</div>
			<div class="am-form-group">
				<div class="am-u-sm-10 am-u-sm-offset-2">
					<input type="submit" value="修改" class="am-btn am-btn-success">
				</div>	
			</div>
			</form>
	</div>
</div>
<?php require_once("admin-footer.php")?>