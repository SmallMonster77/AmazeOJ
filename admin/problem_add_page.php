<?php 
	$title="添加题目";
	include "admin-header.php";
	include "admin-main.php";
	$c=array("语言入门","贪心算法","搜索","数据结构","动态规划","STL练习","大数问题","图论","计算几何","数论","矩阵计算");
?>
<?php include_once("../fckeditor/fckeditor.php"); ?>
<div class="admin-content">
	<div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">添加题目</strong></div>
    </div>
	<div class="am-container">
		<form class="am-form am-form-horizontal" method="post" action="problem_add.php">
			 <div class="am-form-group">
			    <h3 class="am-u-sm-2" align="right">标题：</h3>
			    <div class="am-u-sm-10">
			      <input class="am-input-sm" type="text" name="title" size="71" style="width:550px;" placeholder="题目的标题">
			    </div>
		 	 </div>
		 	 <div class="am-form-group">
			    <h3 class="am-u-sm-2" align="right">时间限制：</h3>
			    <div class="am-u-sm-10">
			      <input class="am-input-sm" type="text" name="time_limit" size="20" style="width:250px;" placeholder="注意：单位是秒">
			    </div>
		 	 </div>
		 	 <div class="am-form-group">
			    <h3 class="am-u-sm-2" align="right">内存限制：</h3>
			    <div class="am-u-sm-10">
			      <input class="am-input-sm" type="text" name="memory_limit" size="20" style="width:250px;" placeholder="注意：单位是MByte">
			    </div>
		 	 </div>
		 	 <div class="am-form-group">
		 	 	<h3 class="am-u-sm-2" align="right">分类：</h3>
		 	 	<div class="am-u-sm-10">
			 	 	<select class="am-round" name="classify" data-am-selected="{btnWidth: '100px'}">
			 	 		<?php
			 	 			$i=1;
			 	 			for(;$i<=11;$i++){
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
					$description->Value = '<p></p>' ;
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
					$input->Value = '<p></p>' ;
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
					$output->Value = '<p></p>' ;
					$output->Create() ;
				?>
		 	 </div>
		 	 <div class="am-form-group">
		 	 	<h3>Sample Input:</h3>
		 	 	<textarea rows="5" name="sample_input" style="width:83%"></textarea>
		 	 </div>
		 	 <div class="am-form-group">
		 	 	<h3>Sample Output:</h3>
		 	 	<textarea rows="5" name="sample_output" style="width:83%"></textarea>
		 	 </div>
		 	 <div class="am-form-group">
		 	 	<h3>Test Input:</h3>
		 	 	<textarea rows="5" name="test_input" style="width:83%"></textarea>
		 	 </div>
		 	 <div class="am-form-group">
		 	 	<h3>Test Output:</h3>
		 	 	<textarea rows="5" name="test_output" style="width:83%"></textarea>
		 	 </div>
		 	 <div class="am-form-group">
		 	 	<h3>Hint:</h3>
				<?php
					$output = new FCKeditor('hint') ;
					$output->BasePath = '../fckeditor/' ;
					$output->Height = 250 ;
					$output->Width=800;
					$output->Value = '<p></p>' ;
					$output->Create() ;
				?>		 	 	
		 	 </div>
		 	 <div class="am-form-group">
		 	 	SpecialJudge: N<input type=radio name=spj value='0' checked>Y<input type=radio name=spj value='1'>
		 	 </div>
		 	 <div class="am-form-group">
		 	 	Source:<textarea rows="1" name="source" style="width:83%"></textarea>
		 	 </div>
		 	 <div class="am-form-group">
		 	 	<button type="submit" class="am-btn am-btn-success" style="margin-bottom:40px;">submit</button>
		 	 </div>
		</form>
	</div>
</div>

<?php include "admin-footer.php"?>