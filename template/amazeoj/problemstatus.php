<?php
	$title="当前题目状态";
	require_once("header.php");
?>
<div class="am-container" style="margin-top:40px;">
	<h3 style="color:red;">Problems <?php echo $id?> Status</h3>
	<hr />
	<div class="am-g">
		<div class="am-u-sm-3">
			<table class="am-table am-table-hover">
				<tbody>
					<?php
						foreach($view_problem as $row){
							echo "<tr>";
							foreach($row as $table_cell){
								echo "<td>";
								echo $table_cell;
								echo "</td>";
							}
							echo "</tr>";
						}
					?>
				</tbody>
			</table>
		</div>
		<div class="am-u-sm-9">
			<table class="am-table am-table-hover">
				<thead>
					<th>#</th>
					<th>运行号</th>
					<th>用户</th>
					<th>内存</th>
					<th>耗时</th>
					<th>语言</th>
					<th>长度</th>
					<th>时间</th>
				</thead>
				<tbody>
					<?php
						foreach($view_solution as $row){
							echo "<tr>";
							foreach($row as $table_cell){
								echo "<td>";
								echo $table_cell;
								echo "</td>";
							}
							echo "</tr>";
						}
					?>
				</tbody>
			</table>
			<ul class="am-pagination">
				<?php
					echo "<li><a href='problemstatus.php?id=$id'>[TOP]</a></li>";
					echo "<li><a href='status.php?problem_id=$id'>[STATUS]</a></li>";
					if ($page>$pagemin){
						$page--;
						echo "<li><a href='problemstatus.php?id=$id&page=$page'>[PREV]</a>/li>";
						$page++;
					}
					if ($page<$pagemax){
						$page++;
						echo "<li><a href='problemstatus.php?id=$id&page=$page'>[NEXT]</a>/li>";
						$page--;
					}	
				?>
			</ul>
		</div>
	</div>
</div>

<?php require_once("footer.php")?>