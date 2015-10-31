<?php $title="排行榜";?>
<?php include "contest_header.php" ?>
<div style="margin-top:40px;" class="am-g">
	<h3 align="center">Contest RankList</h3>
	<hr />
	<div class="">
		<table class="am-table am-table-bordered am-table-striped" id="rank">
		<thead align="center">
			<td width="70px">Rank</td>
			<td>User</td>
			<td>Nick</td>
			<td>Solved</td>
			<td>Penalty</td>
			<?php
				for ($i=0;$i<$pid_cnt;$i++)
				  echo "<td><a href=problem.php?cid=$cid&pid=$i>$PID[$i]</a></td>";
			?>
		</thead>
		<tbody>
			<?php
				$rank=1;
				for ($i=0;$i<$user_cnt;$i++){
					echo "<tr align=center>";
					echo "<td><btn type='button' class=''>";
					$uuid=$U[$i]->user_id;
				  $nick=$U[$i]->nick;
				  if($nick[0]!="*")
				        echo $rank++;//名次变量
				  else 
				        echo "*";
				  echo "</btn></td>"; 
					$usolved=$U[$i]->solved;
				  if($uuid==$_GET['user_id']) echo "<td>";
				  else echo"<td>";
					echo "<a name=\"$uuid\" href=userinfo.php?user=$uuid>$uuid</a>";
					echo "<td><a href=userinfo.php?user=$uuid>".$U[$i]->nick."</a>";
					echo "<td><a href=status.php?user_id=$uuid&cid=$cid>$usolved</a>";
					echo "<td>".sec2str($U[$i]->time);
					for ($j=0;$j<$pid_cnt;$j++){
						//$bg_color="eeeeee";
						 if (isset($U[$i]->p_ac_sec[$j])&&$U[$i]->p_ac_sec[$j]>0){
							$bg_color="am-success";
				                
				                
				                  //$bg_color="aaffaa";
				                        if($uuid==$first_blood[$j]){
				                                $bg_color="am-primary";
				                        }
							
				                        
				                        
						}else if(isset($U[$i]->p_wa_num[$j])&&$U[$i]->p_wa_num[$j]>0) {
							$bg_color="am-danger";
						}
						 echo "<td class=$bg_color>";
						if(isset($U[$i])){
							if (isset($U[$i]->p_ac_sec[$j])&&$U[$i]->p_ac_sec[$j]>0)
								echo sec2str($U[$i]->p_ac_sec[$j]);
							if (isset($U[$i]->p_wa_num[$j])&&$U[$i]->p_wa_num[$j]>0) 
								echo "(-".$U[$i]->p_wa_num[$j].")";
						}
						$bg_color="";
						echo "</td>";
					}
					echo "</tr>";
				}				
			?>
		</tbody>
	</table>
	</div>
</div>
<script>
  function getTotal(rows){
    var total=0;
   // alert(rows.length);
    for(var i=0;i<rows.length&&total==0;i++){
      try{
      	//alert(rows[rows.length-i].cells[0].children[0].innerHTML);
         total=parseInt(rows[rows.length-i].cells[0].children[0].innerHTML);
          if(isNaN(total)) total=0;
          //alert(total);
      }catch(e){
      
      }
    }
    return total;
  
  }
function metal(){
  var tb=window.document.getElementById('rank');
  var rows=tb.rows;
  try{
  var total=getTotal(rows);
  //alert(total);
	  for(var i=1;i<rows.length;i++){
	  	var cell=rows[i].cells[0].children[0];
      var acc=rows[i].cells[3];
      var ac=parseInt(acc.innerText);
      if (isNaN(ac)) ac=parseInt(acc.textContent);
                
                
	  	if(cell.innerHTML!="*"&&ac>0){
	 
	  	     var r=parseInt(cell.innerHTML);
	  	     if(r==1){
	  	       cell.innerHTML="Winner";
                       //cell.style.cssText="background-color:gold;color:red";
                       cell.className="am-btn am-btn-warning am-round am-btn-sm";
	  	     }
	  	     if(r>1&&r<=total*.05+1)
	  	        cell.className="am-btn am-btn-warning am-round am-btn-sm";
	  	     if(r>total*.05+1&&r<=total*.20+1)
	  	        cell.className="am-btn am-btn-primary am-round am-btn-sm";
	  	     if(r>total*.20+1&&r<=total*.45+1)
	  	        cell.className="am-btn am-btn-secondary am-round am-btn-sm";
	  	     if(r>total*.45+1&&ac>0)
              		cell.className="am-btn am-btn-default am-round am-btn-sm";
	  	}
	  }
  }catch(e){
     //alert(e);
  }
}
metal();
</script>

<?php include "footer.php" ?>