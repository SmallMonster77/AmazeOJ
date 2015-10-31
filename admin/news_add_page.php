<?php
	$title="添加公告";
	require_once("admin-header.php");
	require_once("admin-main.php");
	require_once("../fckeditor/fckeditor.php");
?>
<div class="admin-content">
	<div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">添加公告</strong></div>
    </div>
    <hr />
    <div class="am-container">
    	<form class="am-form am-form-horizontal" action="news_add.php" method="post">
	    	<div class="am-form-group">
	    		<label for="doc-ipt-3" class="am-u-sm-2 am-form-label">标题</label>
			    <div class="am-u-sm-10">
			      <input type="text" id="doc-ipt-3" placeholder="请输入一个标题" name=title >
			    </div>
	    	</div>
	    	<div class="am-form-group">
	    		<label for="doc-ipt-2" class="am-u-sm-2 am-form-label">内容</label>
			    <div class="am-u-sm-10">
			    <?php
					$description = new FCKeditor('content') ;
					$description->BasePath = '../fckeditor/' ;
					$description->Height =350 ;
					$description->Width=800;
					$description->Value = '<p></p>' ;
					$description->Create() ;
				?>
			    </div>
	    	</div>
	    	<?php require_once("../include/set_post_key.php");?>
	    	<div class="am-form-group">
	    		<div class="am-u-sm-10 am-u-sm-offset-2">
	    			<input type=submit value=提交 name=submit class="am-btn am-btn-success">
	    		</div>		
	    	</div>
			
		</form>
    </div>
</div>
<?php require_once("admin-footer.php")?>