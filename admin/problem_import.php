<?php 
	$title="批量导入";
	require_once("admin-header.php");
	require_once("admin-main.php");
	function writable($path){
		$ret=false;
		$fp=fopen($path."/testifwritable.tst","w");
		$ret=!($fp===false);
		fclose($fp);
		unlink($path."/testifwritable.tst");
		return $ret;
	}
	$maxfile=min(ini_get("upload_max_filesize"),ini_get("post_max_size"));
?>
<div class="admin-content">
	<div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">批量导入题目</strong></div>
    </div> 
    <div class="am-container">
		<?php 
		    $show_form=true;
		   if(!isset($OJ_SAE)||!$OJ_SAE){
			   if(!writable($OJ_DATA)){
				   echo " You need to add  $OJ_DATA into your open_basedir setting of php.ini,<br>
							or you need to execute:<br>
							   <b>chmod 775 -R $OJ_DATA && chgrp -R www-data $OJ_DATA</b><br>
							you can't use import function at this time.<br>"; 
					$show_form=false;
			   }
			   mkdir("../upload");
			   if(!writable("../upload")){
			   	 
				   echo "../upload is not writable, <b>chmod 770</b> to it.<br>";
				   $show_form=false;
			   }
			}	
			if($show_form){
		?>
		<br>
		<form action='problem_import_xml.php' method=post enctype="multipart/form-data">
			<b>Import Problem:</b><br />
			<div class="am-form-group am-form-file">
				<div>
					<button type="button" class="am-btn am-btn-warning am-btn-sm">
					<i class="am-icon-cloud-upload"></i> 选择要上传的文件</button>
				</div>	
				<input type=file name=fps >			
				<?php require_once("../include/set_post_key.php");?>
			</div>
		    <input type=submit value='导入' class="am-btn am-btn-success">
		</form>		
		<?php   
		   	}	   
		?>
    </div>
</div>
<?php require_once("admin-footer.php"); ?>