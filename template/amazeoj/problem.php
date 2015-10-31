<?php $title="题目信息";?>
<?php
 	require_once("header.php");
 	function sss($str){
 		$after = preg_replace( '/<[^<]+?>/' ,'FUCK$0FUCK', $str);
		$after = preg_replace( '/(?<!FUCK)</' ,'&lt;', $after);
		$after = preg_replace( '/FUCK(?=<)/' ,'', $after);
		$after = preg_replace( '/>(?!FUCK)/' ,'&gt;', $after);
		$after = preg_replace( '/(?<=>)FUCK/' ,'', $after);
		return $after;
 	}
?>
<div class="am-container">
	<h1 style="text-align:center;margin-top:40px;"><?php echo $row->title?></h1>
	<div style="text-align:center;">
		时间限制：<span class="am-badge am-badge-success am-round"><?php echo $row->time_limit?>秒</span> 
		内存限制：<span class="am-badge am-badge-danger am-round"><?php echo $row->memory_limit?>兆</span></span>
		<?php if($row->spj) echo "<span class='am-badge am-badge-warning am-round'>Special Judge</span>"?>
	</div>
	<div style="text-align:center;">
		提交：<span class="am-badge am-round"><?php echo $row->submit?></span>&nbsp;&nbsp;成功：<span class="am-badge am-badge-secondary am-round"><?php echo $row->accepted?></span>
	</div>
	<?php
			$sinput=str_replace("<","&lt;",$row->sample_input);
		  $sinput=str_replace(">","&gt;",$sinput);
			$soutput=str_replace("<","&lt;",$row->sample_output);
		  $soutput=str_replace(">","&gt;",$soutput);

	?>
	<h3>题目描述</h3>
	<p>
		<?php 
			//编码转义未解决！
			//$tt=htmlspecialchars($row->description);
			echo sss($row->description);
		?>
	</p>
	<h3>输入</h3>
	<p>
		<?php echo sss($row->input);?>
	</p>
	<h3>输出</h3>
	<p>
		<?php echo sss($row->output)?>
	</p>
	<h3>样例输入</h3>
	<pre>
		<?php echo $sinput?>
	</pre>
	<h3>样例输出</h3>
	<pre>
		<?php echo $soutput?>
	</pre>
	<h3>提示</h3>
	<p>
		
	</p>
	<h3>来源</h3>
	<p>
		
	</p>
	<div class="am-u-sm-offset-8 am-u-sm-4 am-u-sm-centered">
		<button type="button" class="am-btn am-btn-sm am-btn-primary am-radius"><a href="
		<?php
			if ($pr_flag){
				echo "submitpage.php?id=$id";
			}else{
				echo "submitpage.php?cid=$cid&pid=$pid&langmask=$langmask";
			}
		?>
		" style="color:white">提交</a></button>&nbsp;&nbsp;
		<button type="button" class="am-btn am-btn-sm am-btn-primary am-radius"><a href="problemstatus.php?id=<?php echo $row->problem_id?>" style="color:white">状态</a></button>&nbsp;&nbsp;
		<button type="button" class="am-btn am-btn-sm am-btn-primary am-radius"><a href="#" style="color:white">讨论</a></button>&nbsp;&nbsp;
		<?php
			if(isset($_SESSION['administrator'])){
				echo "<button type='button' class='am-btn am-btn-sm am-btn-primary am-radius'><a href='./admin/quixplorer/index.php?action=list&dir={$row->problem_id}&order=name&srt=yes' style='color:white'>数据</a></button>";
			}
		?>
	</div>
</div>
<?php require_once("footer.php"); ?>