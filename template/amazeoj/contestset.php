<?php $title="比赛";?>
<?php include "header.php" ?>
<div class="am-container">
	<hr / style="margin-top:60px;">
	<h3>服务器当前时间：<span id=nowdate></span></h3>
	<hr />
	<table class="am-table">
		<thead>
			<td>ID</td>
			<td>Name</td>
			<td>Status</td>
			<td>Private</td>
		</thead>
		<tbody>
			<?php
				foreach($view_contest as $row){
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