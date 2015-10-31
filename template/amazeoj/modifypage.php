<?php $title="信息修改";?>
<?php require_once("header.php") ?>
<div class="am-container">
	<legend align="center" style="margin-top:40px;">信息修改</legend>
	<form class="am-form am-form-horizontal" action="modify.php" method="post">
		  <div class="am-form-group">
		  	<label class="am-u-sm-2 am-u-sm-offset-2 am-form-label">用户ID:</label>
		    <div class="am-u-sm-8">
		      <label class="am-form-label"><?php echo $_SESSION['user_id']?></label>
		      <?php require_once('./include/set_post_key.php');?>
		    </div>
		  </div>
		  <div class="am-form-group">
		    <label class="am-u-sm-2 am-u-sm-offset-2 am-form-label">昵称:</label>
		    <div class="am-u-sm-8">
		      <input type="text" style="width:340px;" value="" name="nick">
		    </div>
		  </div> 
		  <div class="am-form-group">
		    <label class="am-u-sm-2 am-u-sm-offset-2 am-form-label">旧密码:</label>
		    <div class="am-u-sm-8">
		      <input type="password" style="width:340px;" name="opassword">
		    </div>
		  </div> 
		  <div class="am-form-group">
		    <label class="am-u-sm-2 am-u-sm-offset-2 am-form-label">新密码:</label>
		    <div class="am-u-sm-8">
		      <input type="password" style="width:340px;" name="npassword">
		    </div>
		  </div> 
		  <div class="am-form-group">
		    <label class="am-u-sm-2 am-u-sm-offset-2 am-form-label">重复新密码:</label>
		    <div class="am-u-sm-8">
		      <input type="password" style="width:340px;" name="rptpassword">
		    </div>
		  </div> 
		  <div class="am-form-group">
		    <label class="am-u-sm-2 am-u-sm-offset-2 am-form-label">学校:</label>
		    <div class="am-u-sm-8">
		      <input type="text" style="width:340px;" value="<?php echo htmlspecialchars($row->school)?>" name="school">
		    </div>
		  </div> 
		  <div class="am-form-group">
		    <label class="am-u-sm-2 am-u-sm-offset-2 am-form-label">邮箱:</label>
		    <div class="am-u-sm-8">
		      <input type="text" style="width:340px;" value="<?php echo htmlspecialchars($row->email)?>" name="email">
		    </div>
		  </div> 
		  <div class="am-form-group">
		  	  <div class="am-u-sm-8 am-u-sm-offset-4">
		  		<input type="submit" value="修改" name="submit" class="am-btn am-btn-success">
		  	  </div>
		  </div>
	</form>
</div>



<?php require_once("footer.php") ?>