<?php 
	$title="题目管理";
	include "admin-header.php";
	include "admin-main.php";
	require_once("../include/set_get_key.php");
	$c=array("语言入门","贪心算法","搜索","数据结构","动态规划","STL练习","大数问题","图论","计算几何","数论","矩阵计算");
?>
<?php
	$keyword=$_GET['keyword'];
	$keyword=mysql_real_escape_string($keyword);
	$sql="SELECT max(`problem_id`) as upid FROM `problem`";
	$page_cnt=50;
	$result=mysql_query($sql);
	echo mysql_error();
	$row=mysql_fetch_object($result);
	$cnt=intval($row->upid)-1000;
	$cnt=intval($cnt/$page_cnt)+(($cnt%$page_cnt)>0?1:0);
	if (isset($_GET['page'])){
	        $page=intval($_GET['page']);
	}else $page=$cnt;
	$pstart=1000+$page_cnt*intval($page-1);
	$pend=$pstart+$page_cnt;
	$sql="select `problem_id`,`title`,`in_date`,`defunct`,`classify` FROM `problem` where problem_id>=$pstart and problem_id<=$pend order by `problem_id` desc";
	//echo $sql;
	if($keyword) $sql="select `problem_id`,`title`,`in_date`,`defunct` FROM `problem` where title like '%$keyword%' or source like '%$keyword%'";
	$result=mysql_query($sql) or die(mysql_error());
?>
<style type="text/css">
	.ttt{
		margin-left: -33px;
	}
</style>
<div class="admin-content">
	<div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">题目管理</strong></div>
    </div>
    <hr/>
    <div class="am-container">
    <form method="post" action="contest_add.php">
    	<input type=submit name='problem2contest' value='添加至比赛' class="am-btn am-btn-success" style="margin-bottom:10px;">

    	<table class="am-table am-table-bordered am-table-hover">
		<thead class="am-text-center">
			<tr>
				<th>题号</th>
				<th>标题</th>
				<th>分类</th>
				<th>添加时间</th>
				<th>状态</th>
				<th>管理</th>
			</tr>
		</thead>
		<tbody>
		<?php
			for (;$row=mysql_fetch_object($result);){
				echo "<tr>";
				echo "<td>".$row->problem_id;
				echo "<input type=checkbox name='pid[]' value='$row->problem_id'>";
				echo "<td><a href='../problem.php?id=$row->problem_id'>".$row->title."</a>";
				echo "<td>{$c[$row->classify-1]}";
     		    echo "<td>".$row->in_date;
     		    echo "<td><a href=problem_df_change.php?id=$row->problem_id&getkey=".$_SESSION['getkey'].">"
                        .($row->defunct=="N"?"<span titlc='click to reserve it'>Available</span>":"<span title='click to be available'>Reserved</span>")."</a></td>";
				echo <<<EOF
				<td>
					<ul>
						<li class="am-dropdown" data-am-dropdown>
						<a class="am-dropdown-toggle ttt" data-am-dropdown-toggle href="javascript:;">管理<span class="am-icon-caret-down"></span>
				        </a>
				        <ul class="am-dropdown-content">
				          <li><a href="problem_edit.php?id={$row->problem_id}&getkey={$_SESSION['getkey']}"><span class="am-icon-cog"></span> 编辑题目</a></li>
				          <li><a href="problem_df_change.php?id={$row->problem_id}&getkey={$_SESSION['getkey']}"><span class="am-icon-cog"></span> 改变状态</a></li>
				          <li><a href="quixplorer/index.php?action=list&dir={$row->problem_id}&order=name&srt=yes"><span class="am-icon-cog"></span> 添加数据</a></li>
				          <li><a href="#" onclick='javascript:if(confirm("Delete?")) location.href="problem_del.php?id={$row->problem_id}&getkey={$_SESSION['getkey']}";'><span class="am-icon-cog"></span> 删除题目</a></li>
				        </ul>
						</li>
					</ul>
				</td>
EOF;
			}
		?>

		</tbody>
	</table>
    </form>
	
	<ul class="am-pagination am-pagination-centered" style="margin-bottom:60px;">
	<?php
		//分页
		for ($i=1;$i<=$cnt;$i++){
	        if ($i==$page) echo "<li class='am-active'><a href='problem_list.php?page=".$i."'>".$i."</a></li>";
	        else echo "<li><a href='problem_list.php?page=".$i."'>".$i."</a></li>";
		}
	?>
	</ul>
		</div>
</div>

<?php include "admin-footer.php"?>