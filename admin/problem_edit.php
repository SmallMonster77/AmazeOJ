<?php 
	$title="添加题目";
	require_once("admin-header.php");
	require_once("admin-main.php");
	$c=array("语言入门","贪心算法","搜索","数据结构","动态规划","STL练习","大数问题","图论","计算几何","数论","矩阵计算");
?>
<?php include_once("../fckeditor/fckeditor.php"); ?>
<div class="admin-content">
	<div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">添加题目</strong></div>
    </div>
    <?php 
    	if(isset($_GET['id'])){
			require_once("../include/check_get_key.php");
	?>
	<?php
		$sql="SELECT * FROM `problem` WHERE `problem_id`=".intval($_GET['id']);
		$result=mysql_query($sql);
		$row=mysql_fetch_object($result);
	?>
	<div class="am-container">
		<form class="am-form am-form-horizontal" method="post" action="problem_edit.php">
			 <div class="am-form-group">
			    <h3 class="am-u-sm-2" align="right">标题：</h3>
			    <div class="am-u-sm-10">
			    	<input type=hidden name=problem_id value='<?php echo $row->problem_id?>'>
			      <input class="am-input-sm" type="text" name="title" size="71" style="width:550px;" placeholder="题目的标题"
			      value="<?php echo htmlspecialchars($row->title)?>">
			    </div>
		 	 </div>
		 	 <div class="am-form-group">
			    <h3 class="am-u-sm-2" align="right">时间限制：</h3>
			    <div class="am-u-sm-10">
			      <input class="am-input-sm" type="text" name="time_limit" size="20" style="width:250px;" placeholder="注意：单位是秒"
			      value='<?php echo $row->time_limit?>'>
			    </div>
		 	 </div>
		 	 <div class="am-form-group">
			    <h3 class="am-u-sm-2" align="right">内存限制：</h3>
			    <div class="am-u-sm-10">
			      <input class="am-input-sm" type="text" name="memory_limit" size="20" style="width:250px;" placeholder="注意：单位是MByte" value='<?php echo $row->memory_limit?>'>
			    </div>
		 	 </div>
		 	 <div class="am-form-group">
		 	 	<h3 class="am-u-sm-2" align="right">分类：</h3>
		 	 	<div class="am-u-sm-10">
			 	 	<select class="am-round" name="classify" data-am-selected="{btnWidth: '100px'}">
			 	 		<?php
			 	 			$i=1;
			 	 			for(;$i<=11;$i++){
			 	 				if($row->classify == $i)
			 	 					echo "<option value='$i' selected>".$c[$i-1]."</option>";
			 	 				else
			 	 					echo "<option value='$i'>".$c[$i-1]."</option>";
			 	 			}
			 	 		?>
			 	 	</select>
		 	 	</div>
		 	 </div>
		 	 <div class="am-form-group">
		 	 	<h3>描述：</h3>
		 	 	<?php
					$description = new FCKeditor('description') ;
					$description->BasePath = '../fckeditor/' ;
					$description->Height = 250 ;
					$description->Width=800;
					$description->Value = $row->description ;
					$description->Create() ;
				?>
		 	 </div>
		 	 <div class="am-form-group">
		 	 	<h3>输入：</h3>
		 	 	<?php
					$input = new FCKeditor('input') ;
					$input->BasePath = '../fckeditor/' ;
					$input->Height = 250 ;
					$input->Width=800;
					$input->Value = $row->input ;
					$input->Create() ;
				?>
		 	 </div>
		 	 <div class="am-form-group">
		 	 	<h3>输出：</h3>
		 	 	<?php
					$output = new FCKeditor('output') ;
					$output->BasePath = '../fckeditor/' ;
					$output->Height = 250 ;
					$output->Width=800;
					$output->Value = $row->output ;
					$output->Create() ;
				?>
		 	 </div>
		 	 <div class="am-form-group">
		 	 	<h3>Sample Input:</h3>
		 	 	<textarea rows="5" name="sample_input" style="width:83%"><?php echo htmlspecialchars($row->sample_input)?></textarea>
		 	 </div>
		 	 <div class="am-form-group">
		 	 	<h3>Sample Output:</h3>
		 	 	<textarea rows="5" name="sample_output" style="width:83%"><?php echo htmlspecialchars($row->sample_output)?></textarea>
		 	 </div>
		 	 <div class="am-form-group">
		 	 	<h3>Hint:</h3>
				<?php
					$output = new FCKeditor('hint') ;
					$output->BasePath = '../fckeditor/' ;
					$output->Height = 250 ;
					$output->Width=800;
					$output->Value = $row->hint ;
					$output->Create() ;
				?>		 	 	
		 	 </div>
		 	 <div class="am-form-group">
		 	 	SpecialJudge: 
				N<input type=radio name=spj value='0' <?php echo $row->spj=="0"?"checked":""?>>
				Y<input type=radio name=spj value='1' <?php echo $row->spj=="1"?"checked":""?>>
		 	 </div>
		 	 <div class="am-form-group">
		 	 	Source:<textarea rows="1" name="source" style="width:83%"><?php echo htmlspecialchars($row->source)?></textarea>
		 	 </div>
		 	 <div class="am-form-group">
		 	 	<?php require_once("../include/set_post_key.php");?>
		 	 	<button type="submit" class="am-btn am-btn-success" style="margin-bottom:40px;">submit</button>
		 	 </div>
		</form>
		<?php }
		else{
				require_once("../include/check_post_key.php");
				$id=intval($_POST['problem_id']);
				if(!(isset($_SESSION["p$id"])||isset($_SESSION['administrator']))) exit();	
				$title=$_POST['title'];
				$time_limit=$_POST['time_limit'];
				$memory_limit=$_POST['memory_limit'];
				$description=$_POST['description'];
				$input=$_POST['input'];
				$output=$_POST['output'];
				$sample_input=$_POST['sample_input'];
				$sample_output=$_POST['sample_output'];
				$hint=$_POST['hint'];
				$source=$_POST['source'];
				$spj=$_POST['spj'];
				$classify=$_POST['classify'];
				if (get_magic_quotes_gpc ()) {
					$title = stripslashes ( $title);
					$time_limit = stripslashes ( $time_limit);
					$memory_limit = stripslashes ( $memory_limit);
					$description = stripslashes ( $description);
					$input = stripslashes ( $input);
					$output = stripslashes ( $output);
					$sample_input = stripslashes ( $sample_input);
					$sample_output = stripslashes ( $sample_output);
				//	$test_input = stripslashes ( $test_input);
				//	$test_output = stripslashes ( $test_output);
					$hint = stripslashes ( $hint);
					$source = stripslashes ( $source); 
					$spj = stripslashes ( $spj);
					$source = stripslashes ( $source );
					$classify = stripslashes ( $classify );
				}
				$basedir=$OJ_DATA."/$id";
				echo "Sample data file in $basedir Updated!<br>";

					if($sample_input){
						//mkdir($basedir);
						$fp=fopen($basedir."/sample.in","w");
						fputs($fp,preg_replace("(\r\n)","\n",$sample_input));
						fclose($fp);
						
						$fp=fopen($basedir."/sample.out","w");
						fputs($fp,preg_replace("(\r\n)","\n",$sample_output));
						fclose($fp);
					}
					$title=mysql_real_escape_string($title);
					$time_limit=mysql_real_escape_string($time_limit);
					$memory_limit=mysql_real_escape_string($memory_limit);
					$description=mysql_real_escape_string($description);
					$input=mysql_real_escape_string($input);
					$output=mysql_real_escape_string($output);
					$sample_input=mysql_real_escape_string($sample_input);
					$sample_output=mysql_real_escape_string($sample_output);
				//	$test_input=($test_input);
				//	$test_output=($test_output);
					$hint=mysql_real_escape_string($hint);
					$source=mysql_real_escape_string($source);
				//	$spj=($spj);
					
				$sql="UPDATE `problem` set `title`='$title',`time_limit`='$time_limit',`memory_limit`='$memory_limit',
					`description`='$description',`input`='$input',`output`='$output',`sample_input`='$sample_input',`sample_output`='$sample_output',`hint`='$hint',`source`='$source',`spj`=$spj,`classify`=$classify,`in_date`=NOW()
					WHERE `problem_id`=$id";
				@mysql_query($sql) or die(mysql_error());
				echo "Edit OK!";
			}
		?>
	</div>
</div>
<?php require_once("admin-footer.php"); ?>