<?php $title="数据统计";?>
<?php require_once("header.php") ?>
<div class="am-container" style="margin-top:40px;">
<div align="center">
	<table class="am-table am-table-compact am-table-centered"  style="width:400px;">
	<tbody>
		<tr>
			<td class="am-success">名次</td>
			<td class="am-warning"><?php echo $Rank?></td>
		</tr>
		<tr>
			<td class="am-success">解决</td>
			<td class="am-warning"><a href='status.php?user_id=<?php echo $user?>&jresult=4'><?php echo $AC?></a></td>
		</tr>
		<tr>
			<td class="am-success">提交</td>
			<td class="am-warning"><a href='status.php?user_id=<?php echo $user?>'><?php echo $Submit?></a></td>
		</tr>
		<?php
			foreach($view_userstat as $row){
		//i++;
		echo "<tr><td class='am-success'>".$jresult[$row[0]]."<td class='am-warning'><a href=status.php?user_id=$user&jresult=".$row[0]." >".$row[1]."</a></tr>";
	}
		?>
		
	</tbody>
	</table>
</div>
</div>
<?php require_once("footer.php") ?>