<?php $title="比赛";?>
<?php include "contest_header.php" ?>
<div class="am-container">
	<hr / style="margin-top:30px;">
	<h3>Contest<?php echo $view_cid?> - <?php echo $view_title ?></h3>
	<pre><?php echo $view_description?></pre>
	<h3>开始时间：<span style="color:blue;"><?php echo $view_start_time?></span>&nbsp;&nbsp;&nbsp;&nbsp;结束时间：<span style="color:blue;color:blue;"><?php echo $view_end_time?></span></h3>
	<h3>当前时间：<span style="color:blue;" id=nowdate><?php echo date("Y-m-d H:i:s")?></span>&nbsp;&nbsp;&nbsp;&nbsp;当前状态：<span style="color:red;">
			<?php
				if ($now>$end_time) 
					echo "<span class=red>Ended</span>";
				else if ($now<$start_time) 
					echo "<span class=red>Not Started</span>";
				else 
					echo "<span class=red>Running</span>";
			?>&nbsp;&nbsp;
			<?php
				if ($view_private=='0') 
					echo "<span class=blue>Public</font>";
				else 
					echo "&nbsp;&nbsp;<span class=red>Private</font>"; 
			?>
	</span></h3>
	<hr />
	<table class="am-table">
		<thead>
			<td></td>
			<td>编号</td>
			<td>标题</td>
			<td>来源</td>
			<td>正确</td>
			<td>提交</td>
		</thead>
		<tbody>
			<?php
				foreach($view_problemset as $row){
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
<script>
var diff=new Date("<?php echo date("Y/m/d H:i:s")?>").getTime()-new Date().getTime();
//alert(diff);
function clock()
    {
      var x,h,m,s,n,xingqi,y,mon,d;
      var x = new Date(new Date().getTime()+diff);
      y = x.getYear()+1900;
      if (y>3000) y-=1900;
      mon = x.getMonth()+1;
      d = x.getDate();
      xingqi = x.getDay();
      h=x.getHours();
      m=x.getMinutes();
      s=x.getSeconds();
  
      n=y+"-"+mon+"-"+d+" "+(h>=10?h:"0"+h)+":"+(m>=10?m:"0"+m)+":"+(s>=10?s:"0"+s);
      //alert(n);
      document.getElementById('nowdate').innerHTML=n;
      setTimeout("clock()",1000);
    } 
    clock();
</script>
<?php include "footer.php" ?>