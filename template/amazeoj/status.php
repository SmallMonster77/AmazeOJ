<?php $title="状态";?>
<?php include "header.php" ?>
<style type="text/css">
	.pp{
		margin-top: 30px;
	}
</style>
<div class="am-container pp">
	<form action="status.php" method="get" class="am-form am-form-inline" role="form">
		<div class="am-form-group">
		    <input type="text" class="am-form-field am-round" placeholder="题号" name="problem_id" value="<?php echo $problem_id?>">
		</div>
		<div class="am-form-group">
		    <input type="text" class="am-form-field am-round" placeholder="用户" name="user_id" value="<?php echo $user_id?>">
			<?php if (isset($cid)) echo "<input type='hidden' name='cid' value='$cid'>";?>
		</div>
		<div class="am-form-group">
	      <select class="am-round" name="language" data-am-selected="{btnWidth: '100px'}">
		<?php 
			if (isset($_GET['language'])) $language=$_GET['language'];
				else $language=-1;
			if ($language<0||$language>=count($language_name)) 
				$language=-1;
			if ($language==-1) 
				echo "<option value='-1' selected>All</option>";
			else 
				echo "<option value='-1'>All</option>";
			$i=0;
			foreach ($language_name as $lang){
			        if ($i==$language)
			                echo "<option value=$i selected>$language_name[$i]</option>";
			        else
			                echo "<option value=$i>$language_name[$i]</option>";
			        $i++;
			}
		?>
	      </select>
	      <span class="am-form-caret"></span>
	    </div>
	    <div class="am-form-group">
	      <select class="am-round" name="jresult" data-am-selected="{btnWidth: '100px'}">
			<?php 
				if (isset($_GET['jresult'])) 
					$jresult_get=intval($_GET['jresult']);
				else 
					$jresult_get=-1;
				if ($jresult_get>=12||$jresult_get<0) 
					$jresult_get=-1;
				     /*if ($jresult_get!=-1){
				        $sql=$sql."AND `result`='".strval($jresult_get)."' ";
				        $str2=$str2."&jresult=".strval($jresult_get);
				     }*/
				if ($jresult_get==-1) 
					echo "<option value='-1' selected>All</option>";
				else 
					echo "<option value='-1'>All</option>";
				for ($j=0;$j<12;$j++){
				        $i=($j+4)%12;
				        if ($i==$jresult_get) echo "<option value='".strval($jresult_get)."' selected>".$jresult[$i]."</option>";
				        else echo "<option value='".strval($i)."'>".$jresult[$i]."</option>";
					}
			?>
	      </select>
	      <span class="am-form-caret"></span>
	    </div>
		<button type="submit" class="am-btn am-btn-success am-round">筛选</button>
	</form>
</div>
<div class="am-container">
	<table class="am-table am-table-hover">
		<thead>
			<tr>
				<th>编号</th>
				<th>用户</th>
				<th>题号</th>
				<th>结果</th>
				<th>内存</th>
				<th>耗时</th>
				<th>语言</th>
				<th>长度</th>
				<th>时间</th>
			</tr>
		</thead>
		<tbody>
			<?php
                    foreach($view_status as $row){
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
<div class="am-container am-u-sm-centered am-u-sm-offset-10 am-u-sm-2">
	<div>
		<?php echo "[<a href=status.php?".$str2.">Top</a>]&nbsp;&nbsp;";
		if (isset($_GET['prevtop']))
		        echo "[<a href=status.php?".$str2."&top=".$_GET['prevtop'].">Previous Page</a>]&nbsp;&nbsp;";
		else
		        echo "[<a href=status.php?".$str2."&top=".($top+20).">Previous Page</a>]&nbsp;&nbsp;";
		echo "[<a href=status.php?".$str2."&top=".$bottom."&prevtop=$top>Next Page</a>]";
		?>
	</div>
</div>
<?php include "footer.php" ?>