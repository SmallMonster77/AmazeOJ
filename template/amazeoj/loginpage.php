<?php $title="登录";?>
<?php include "header.php" ?>
<div class="am-g">
	<div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
		<br>
	    <br>
	    <br>
	    <br>
	    <h3>登录页</h3>
		<hr>
		<form action="login.php" method="post" class="am-form am-form-horizontal">
		<div class="am-form-group">
			<label for="username" class="am-u-sm-4 am-form-label">用户名：</label>
			<div class="am-u-sm-8">
				<input type="text" name="user_id" id="username" value="" placeholder="输入一个用户名" style="width:300px;">
			</div>	
		</div>
		<div class="am-form-group">
			<label for="pwd" class="am-u-sm-4 am-form-label">密码：</label>
			<div class="am-u-sm-8">
				<input type="password" name="password" id="pwd" value="" placeholder="输入一个密码" style="width:300px;">
			</div>	
		</div>
		<div class="am-from-group">
			<div class="am-cf am-u-sm-offset-4 am-u-sm-4 am-u-end">
		        <input type="submit" name="submit" value="登 录" class="am-btn am-btn-primary am-btn-sm am-fl">
		        <input type="submit" name="" value="忘记密码? " class="am-btn am-btn-default am-btn-sm am-fr">
		      </div>
		    </div>
		</div>
		</form>
	</div>
	<br>
	<br>
	<br>
	<br>
</div>
<?php include "footer.php" ?>
