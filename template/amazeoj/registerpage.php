<?php $title="注册";?>
<?php include "header.php" ?>
<div class="am-g">
	<div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
		<br>
	    <br>
	    <h3>注册页</h3>
		<hr>
		<form class="am-form am-form-horizontal" action="register.php" method="post" data-am-validator>
		<div class="am-form-group">
			<label for="username" class="am-u-sm-4 am-form-label">用户名：</label>
			<div class="am-u-sm-8">
				<input type="text" name="user_id" id="username" value="" placeholder="输入一个用户名(3-20长度)" style="width:300px;"
				 minlength="3" maxlength="20" required/>
			</div>	
		</div>
		<div class="am-form-group">
			<label for="pwd" class="am-u-sm-4 am-form-label">密码：</label>
			<div class="am-u-sm-8">
				<input type="password" name="password" id="pwd" value="" placeholder="输入一个密码" style="width:300px;" 
				pattern="^[\@A-Za-z0-9\!\#\$\%\^\&\*\.\~]{6,22}$" required/>
			</div>	
		</div>
		<div class="am-form-group">
			<label for="rname" class="am-u-sm-4 am-form-label">重复密码：</label>
			<div class="am-u-sm-8">
				<input type="password" id="rname" name="rptpassword"value="" style="width:300px;" placeholder="重复密码" 
				data-equal-to="#pwd" required/>
			</div>	
		</div>
		<div class="am-form-group">
			<label for="nc" class="am-u-sm-4 am-form-label">昵称：</label>
			<div class="am-u-sm-8">
				<input type="text" id="nc" name="nick"value="" style="width:300px;" placeholder="昵称" minlength="1">
			</div>	
		</div>
		<div class="am-form-group">
			<label for="school" class="am-u-sm-4 am-form-label">学校：</label>
			<div class="am-u-sm-8">
				<input type="text" id="school" name="school"value="" style="width:300px;" placeholder="学校">
			</div>	
		</div>
		<div class="am-form-group">
			<label for="email" class="am-u-sm-4 am-form-label">邮箱：</label>
			<div class="am-u-sm-8">
				<input type="email" id="email" value="" name="email" style="width:300px;" placeholder="电子邮箱" 
				 required/>
			</div>	
		</div>
		<div class="am-from-group">
			<div class="am-cf am-u-sm-offset-4 am-u-sm-3 am-u-end">
		        <input type="submit" name="submit" value="注 册" class="am-btn am-btn-primary am-btn-sm am-fl am-btn-block">
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