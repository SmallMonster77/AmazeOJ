<?php
	$title="重判";
	require_once("admin-header.php");
	require_once("admin-main.php");
?>

<div class="admin-content">
	<div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">重判</strong></div>
    </div>
    <hr />
    <div class="am-container">
    	<form class="am-form am-form-horizontal" method="post" action='rejudge.php'>
    		<div class="am-form-group">
    			<label for="doc-ipt-3" class="am-u-sm-2 am-form-label">Problem:</label>
    			<div class="am-u-sm-10">
    				<input type=input name='rjpid'>	<input type='hidden' name='do' value='do'>&nbsp;&nbsp;&nbsp;&nbsp;
					<input type=submit value=submit class="am-btn am-btn-primary" >
					<?php require_once("../include/set_post_key.php");?>
    			</div>
    		</div>
    	</form>
    	<form class="am-form am-form-horizontal" method="post" action='rejudge.php'>
    		<div class="am-form-group">
    			<label for="doc-ipt-3" class="am-u-sm-2 am-form-label">Solution:</label>
    			<div class="am-u-sm-10">
    				<input type=input name='rjsid'>	<input type='hidden' name='do' value='do'>&nbsp;&nbsp;&nbsp;&nbsp;
					<input type=hidden name="postkey" value="<?php echo $_SESSION['postkey']?>">
					<input type=submit value=submit class="am-btn am-btn-primary">
    			</div>
    		</div>
    	</form>
    </div>
    <hr />
</div>

<?php require_once("admin-footer.php"); ?>