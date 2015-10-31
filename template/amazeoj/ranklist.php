<?php $title="排行";?>
<?php include "header.php" ?>
<div class="am-container">
	<h1 style="text-align:center;margin-top:40px;">Top 50</h1>
	<hr>
	<table class="am-table">
	    <thead>
	        <tr>
	            <th>名次</th>
	            <th>用户</th>
	            <th>昵称</th>
	            <th>正确</th>
	            <th>提交</th>
	            <th>AC率</th>
	        </tr>
	    </thead>
	    <tbody>
	        <?php 
				foreach($view_rank as $row){
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
<?php include "footer.php" ?>