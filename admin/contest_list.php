<?php 
	$title="竞赛列表";
	include "admin-header.php";
	include "admin-main.php";
	require_once("../include/set_get_key.php");
	$sql="SELECT max(`contest_id`) as upid, min(`contest_id`) as btid  FROM `contest`";
	$page_cnt=50;
	$result=mysql_query($sql);
	echo mysql_error();
	$row=mysql_fetch_object($result);
	$base=intval($row->btid);
	$cnt=intval($row->upid)-$base;
	$cnt=intval($cnt/$page_cnt)+(($cnt%$page_cnt)>0?1:0);
	if (isset($_GET['page'])){
	        $page=intval($_GET['page']);
	}else $page=$cnt;
	$pstart=$base+$page_cnt*intval($page-1);
	$pend=$pstart+$page_cnt;
	//分页
	for ($i=1;$i<=$cnt;$i++){
	        if ($i>1) echo '&nbsp;';
	        if ($i==$page) echo "<span class=red>$i</span>";
	        else echo "<a href='contest_list.php?page=".$i."'>".$i."</a>";
	}
	$sql="select `contest_id`,`title`,`start_time`,`end_time`,`private`,`defunct` FROM `contest` where contest_id>=$pstart and contest_id <=$pend order by `contest_id` desc";
	$keyword=$_GET['keyword'];
	$keyword=mysql_real_escape_string($keyword);
	if($keyword) $sql="select `contest_id`,`title`,`start_time`,`end_time`,`private`,`defunct` FROM `contest` where title like '%$keyword%' ";
	$result=mysql_query($sql) or die(mysql_error());
?>
<div class="admin-content">
	<div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">竞赛列表</strong></div>
    </div>
	<table class="am-table am-table-bordered" style="margin-left:10px;">
		<thead>
			<td>ContestID</td>
			<td>Title</td>
			<td>StartTime</td>
			<td>EndTime</td>
			<td>Private</td>
			<td>Status</td>
			<td>Edit</td>
			<td>Copy</td>
			<td>Export</td>	
			<td>Logs</td>
		</thead>
		<tbody>
			<?php
				for (;$row=mysql_fetch_object($result);){
					echo "<tr>";
					echo "<td>".$row->contest_id;
			        echo "<td><a href='../contest.php?cid=$row->contest_id'>".$row->title."</a>";
			        echo "<td>".$row->start_time;
			        echo "<td>".$row->end_time;
			         $cid=$row->contest_id;
        if(isset($_SESSION['administrator'])||isset($_SESSION["m$cid"])){
                echo "<td><a href=contest_pr_change.php?cid=$row->contest_id&getkey=".$_SESSION['getkey'].">".($row->private=="0"?"Public->Private":"Private->Public")."</a>";
                echo "<td><a href=contest_df_change.php?cid=$row->contest_id&getkey=".$_SESSION['getkey'].">".($row->defunct=="N"?"<span class=green>Available</span>":"<span class=red>Reserved</span>")."</a>";
                echo "<td><a href=contest_edit.php?cid=$row->contest_id>Edit</a>";
                echo "<td><a href=contest_add.php?cid=$row->contest_id>Copy</a>";
                if(isset($_SESSION['administrator'])){
                        echo "<td><a href=\"problem_export_xml.php?cid=$row->contest_id&getkey=".$_SESSION['getkey']."\">Export</a>";
                }else{
                  echo "<td>";
                }
     echo "<td> <a href=\"../export_contest_code.php?cid=$row->contest_id&getkey=".$_SESSION['getkey']."\">Logs</a>";
        }else{
                echo "<td colspan=5 align=right><a href=contest_add.php?cid=$row->contest_id>Copy</a><td>";

        }
					echo "</tr>";
				}
			?>
		</tbody>
	</table>
</div>
<?php include "admin-footer.php"?>