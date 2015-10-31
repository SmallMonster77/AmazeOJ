<?php
	$title="公告列表";
	require_once("admin-header.php");
	require_once("admin-main.php");
	require_once("../include/set_get_key.php");
	$sql="select `news_id`,`user_id`,`title`,`time`,`defunct` FROM `news` order by `news_id` desc";
	$result=mysql_query($sql) or die(mysql_error());
?>
<div class="admin-content">
	<div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">公告列表</strong></div>
    </div>
    <hr />
	<div class="am-container">
		<table class="am-table">
			<thead>
				<th>PID</th>
				<th>Title</th>
				<th>Date</th>
				<th>Status</th>
				<th>Edit</th>
				<th>Del</th>
			</thead>
			<tbody>
				<?php
					for (;$row=mysql_fetch_object($result);){
						echo "<tr>";
						echo "<td>".$row->news_id;
						//echo "<input type=checkbox name='pid[]' value='$row->problem_id'>";
						echo "<td><a href='news_edit.php?id=$row->news_id'>".$row->title."</a>";
						echo "<td>".$row->time;
						echo "<td><a href=news_df_change.php?id=$row->news_id&getkey=".$_SESSION['getkey'].">".($row->defunct=="N"?"<span>Available</span>":"<span>Reserved</span>")."</a>";
							echo "<td><a href=news_edit.php?id=$row->news_id>Edit</a>";
						echo <<<st
							<td><a href='#' onclick='javascript:if(confirm("Delete?")) location.href="news_del.php?id={$row->news_id}&getkey={$_SESSION['getkey']}";'>Del</a>
st;
						echo "</tr>";
					}
				?>
			</tbody>
		</table>
	</div>
</div>
<?php require_once("admin-footer.php")?>