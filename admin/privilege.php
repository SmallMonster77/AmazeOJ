<?php 
	$title="权限管理";
	include "admin-header.php";
	include "admin-main.php";
	require_once("../include/set_get_key.php");
?>
<div class="admin-content">
	<div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">权限列表</strong></div>
    </div>
    <hr/>
    <div class="am-container">
    	<table class="am-table am-table-hover">
			<thead>
				<td>用户</td>
				<td>权限</td>
				<td>删除权限</td>
			</thead>
			<?php
				$sql="select * FROM privilege where rightstr in ('administrator','source_browser','contest_creator','http_judge','problem_editor') ";
				$result=mysql_query($sql) or die(mysql_error());
				for (;$row=mysql_fetch_object($result);){
					echo "<tr>";
					echo "<td>".$row->user_id."</td>";
					echo "<td>".$row->rightstr."</td>";
					echo "<td><a href=privilege_delete.php?uid=$row->user_id&rightstr=$row->rightstr&getkey=".$_SESSION['getkey'].">Delete</a>";
					echo "</tr>";
				}
			?>
    	</table>
    </div>
    <hr />
    <div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">添加权限(管理员权限)</strong></div>
    </div>
    <div class="am-container">
 	 <form class="am-form am-form-horizontal" method="post" action="privilege_add.php">
	  <div class="am-form-group">
	    <label for="doc-ipt-3" class="am-u-sm-2 am-form-label">用户:</label>
	    <div class="am-u-sm-10">
	      <input type="text" id="doc-ipt-3" placeholder="用户名，只有administrator权限" style="width:350px;" name="user_id">
	    </div>
	  </div> 
	  <div class="am-form-group">
	  	<div class="am-u-sm-10 am-u-sm-offset-2">
	  		<input type="submit" class="am-btn am-btn-default" value='添加'>
	  	</div>
	  </div>
	  <input type='hidden' name='do' value='do'>
	 </form>  	
    </div>
    <hr />
</div>
<?php include "admin-footer.php"?>