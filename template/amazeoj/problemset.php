<?php $title="题目";?>
<?php 
	require_once("header.php");
?>
<style type="text/css">
	.tt{
		margin-top: 20px;
		margin-bottom: 20px;
	}
</style>
<div class="am-container tt">
	<form class="am-form am-form-inline">
		<div class="am-form-group am-form-icon">
		    <i class="am-icon-search"></i>
		    <input type="text" class="am-form-field am-round" placeholder="输入想搜索的标题" name="search">
	    </div>
	    <button type="submit" class="am-btn am-btn-success am-round ">搜索</button>

	</form>
</div>
<div class="am-container">
	<table class="am-table am-table-hover">
		<thead>
			<tr>
				<th>题号</th>
				<th>标题</th>
				<th>正确/提交</th>
				<th>题目分类</th>
			</tr>
		</thead>
		<tbody>
		<?php
			foreach($view_problemset as $row){
					echo "<tr>";
					foreach($row as $table_cell){
						echo $table_cell;
					}
					
					echo "</tr>";
				}
		?>
		</tbody>
	</table>
</div>
<div class="am-container">
<ul class="am-pagination">
  <?php
  		//分页
 	 for ($i=1;$i<=$view_total_page;$i++){
 	 	if($page==$i)
 	 		echo "<li class='am-active'><a href='problemset.php?page={$i}'>{$i}</a></li>";
 	 	else
 	 		echo "<li><a href='problemset.php?page={$i}'>{$i}</a></li>";
 	 }
  ?>
</ul>
</div>
<?php require_once("footer.php") ?>