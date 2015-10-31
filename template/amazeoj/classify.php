<?php $title="分类";?>
<?php 
	require_once("header.php");
	require_once("./include/db_info.inc.php");
	$c=array("语言入门","贪心算法","搜索","数据结构","动态规划","STL练习","大数问题","图论","计算几何","数论","矩阵计算");
?>
<div class="am-container">
	<h1 style="text-align:center;margin-top:50px;">题目分类</h1>
	<hr>
	<table class="am-table am-table-compact am-table-hover">
	  <thead>
		  <tr>
		    <th>序号</th>
		    <th>题目类型</th>
		    <th>数量</th>
		  </tr>
	  </thead>
	  <tbody>
		  <?php
		  		$typeid=1;
		  		for(;$typeid<=11;$typeid++){
		  			$sql="select count(*) as num from problem where classify='$typeid'";
					$res=mysql_fetch_row(mysql_query($sql));
					$num=$res[0];
					echo "<tr>";
					echo "<td>".$typeid;
					echo "<td><a href='problemset.php?typeid=$typeid'>".$c[$typeid-1]."</a>";
					echo "<td>".$num;
					echo "</tr>";
		  		}
		  ?>
	  </tbody>
	</table>
</div>
<?php require_once("footer.php") ?>