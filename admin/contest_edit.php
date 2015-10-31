<?php 
	require("admin-header.php");
	require("admin-main.php");
	include_once("../fckeditor/fckeditor.php") ;
	include_once("../include/const.inc.php");
if (isset($_POST['syear']))
{
	require_once("../include/check_post_key.php");
	
	$starttime=intval($_POST['syear'])."-".intval($_POST['smonth'])."-".intval($_POST['sday'])." ".intval($_POST['shour']).":".intval($_POST['sminute']).":00";
	$endtime=intval($_POST['eyear'])."-".intval($_POST['emonth'])."-".intval($_POST['eday'])." ".intval($_POST['ehour']).":".intval($_POST['eminute']).":00";
//	echo $starttime;
//	echo $endtime;
	 
	$title=mysql_real_escape_string($_POST['title']);
	$description=mysql_real_escape_string($_POST['description']);
	$private=mysql_real_escape_string($_POST['private']);
	if (get_magic_quotes_gpc ()) {
        $title = stripslashes ( $title);
        //$description = stripslashes ( $description);
  }
   $lang=$_POST['lang'];
   $langmask=0;
   foreach($lang as $t){
			$langmask+=1<<$t;
	} 
	$langmask=((1<<count($language_ext))-1)&(~$langmask);
	echo $langmask;	

	$cid=intval($_POST['cid']);
	if(!(isset($_SESSION["m$cid"])||isset($_SESSION['administrator']))) exit();
	$sql="UPDATE `contest` set `title`='$title',description='$description',`start_time`='$starttime',`end_time`='$endtime',`private`='$private',`langmask`=$langmask WHERE `contest_id`=$cid";
	//echo $sql;
	mysql_query($sql) or die(mysql_error());
	$sql="DELETE FROM `contest_problem` WHERE `contest_id`=$cid";
	mysql_query($sql);
	$plist=trim($_POST['cproblem']);
	$pieces = explode(',', $plist);
	if (count($pieces)>0 && strlen($pieces[0])>0){
		$sql_1="INSERT INTO `contest_problem`(`contest_id`,`problem_id`,`num`) 
			VALUES ('$cid','$pieces[0]',0)";
		for ($i=1;$i<count($pieces);$i++)
			$sql_1=$sql_1.",('$cid','$pieces[$i]',$i)";
		mysql_query("update solution set num=-1 where contest_id=$cid");
		for ($i=0;$i<count($pieces);$i++){
			$sql_2="update solution set num='$i' where contest_id='$cid' and problem_id='$pieces[$i]';";
			mysql_query($sql_2);
		}
		//echo $sql_1;
		
		mysql_query($sql_1) or die(mysql_error());
		$sql="update `problem` set defunct='N' where `problem_id` in ($plist)";
		mysql_query($sql) or die(mysql_error());
	
	}
	
	$sql="DELETE FROM `privilege` WHERE `rightstr`='c$cid'";
	mysql_query($sql);
	$pieces = explode("\n", trim($_POST['ulist']));
	if (count($pieces)>0 && strlen($pieces[0])>0){
		$sql_1="INSERT INTO `privilege`(`user_id`,`rightstr`) 
			VALUES ('".trim($pieces[0])."','c$cid')";
		for ($i=1;$i<count($pieces);$i++)
			$sql_1=$sql_1.",('".trim($pieces[$i])."','c$cid')";
		//echo $sql_1;
		mysql_query($sql_1) or die(mysql_error());
	}
	
	echo "<script>window.location.href=\"contest_list.php\";</script>";
	exit();
}else{
	$cid=intval($_GET['cid']);
	$sql="SELECT * FROM `contest` WHERE `contest_id`=$cid";
	$result=mysql_query($sql);
	if (mysql_num_rows($result)!=1){
		mysql_free_result($result);
		echo "No such Contest!";
		exit(0);
	}
	$row=mysql_fetch_assoc($result);
	$starttime=$row['start_time'];
	$endtime=$row['end_time'];
	$private=$row['private'];
	$langmask=$row['langmask'];
	$description=$row['description'];
	$title=htmlspecialchars($row['title']);
	mysql_free_result($result);
	$plist="";
	$sql="SELECT `problem_id` FROM `contest_problem` WHERE `contest_id`=$cid ORDER BY `num`";
	$result=mysql_query($sql) or die(mysql_error());
	for ($i=mysql_num_rows($result);$i>0;$i--){
		$row=mysql_fetch_row($result);
		$plist=$plist.$row[0];
		if ($i>1) $plist=$plist.',';
	}
	$ulist="";
	$sql="SELECT `user_id` FROM `privilege` WHERE `rightstr`='c$cid' order by user_id";
	$result=mysql_query($sql) or die(mysql_error());
	for ($i=mysql_num_rows($result);$i>0;$i--){
		$row=mysql_fetch_row($result);
		$ulist=$ulist.$row[0];
		if ($i>1) $ulist=$ulist."\n";
	}
	
	
}
?>

<div class="admin-content">
	<div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">竞赛编辑</strong></div>
    </div>    
	<form class="am-form am-form-horizontal" method="post">
	<?php require_once("../include/set_post_key.php");?>
	<input type=hidden name='cid' value=<?php echo $cid?>>
		<div class="am-form-group am-form-group-sm">
			<label class="am-u-sm-2 am-form-label">title:</label>
			<div class="am-u-sm-10">
				<input type="text" name="title" style="width:300px;" class="am-form-field" value="<?php echo $title?>">
			</div>			
		</div>
		<div class="am-form-group am-form-group-sm">
			<label class="am-u-sm-3 am-form-label">Start Time(年-月-日-时-分):</label>
			<div class="am-u-sm-1">
				<input type="text" name="syear" style="width:50px;" class="am-form-field" value="<?php echo substr($starttime,0,4)?>">
			</div>
			<div class="am-u-sm-1">
				<input type="text" name="smonth" style="width:50px;" class="am-form-field" value="<?php echo substr($starttime,5,2)?>">
			</div>	
			<div class="am-u-sm-1">
				<input type="text" name="sday" style="width:50px;" class="am-form-field" value="<?php echo substr($starttime,8,2)?>">
			</div>	
			<div class="am-u-sm-1">
				<input type="text" name="shour" style="width:50px;" class="am-form-field" value="<?php echo substr($starttime,11,2)?>">
			</div>	
			<div class="am-u-sm-1 am-u-end">
				<input type="text" name="sminute" style="width:50px;" class="am-form-field" value="<?php echo substr($starttime,14,2)?>">
			</div>				
		</div>
		<div class="am-form-group am-form-group-sm">
			<label class="am-u-sm-3 am-form-label">End Time(年-月-日-时-分):</label>
			<div class="am-u-sm-1">
				<input type="text" name="eyear" style="width:50px;" class="am-form-field" value="<?php echo substr($endtime,0,4)?>">
			</div>
			<div class="am-u-sm-1">
				<input type="text" name="emonth" style="width:50px;" class="am-form-field" value="<?php echo substr($endtime,5,2)?>">
			</div>	
			<div class="am-u-sm-1">
				<input type="text" name="eday" style="width:50px;" class="am-form-field" value="<?php echo substr($endtime,8,2)?>">
			</div>	
			<div class="am-u-sm-1">
				<input type="text" name="ehour" style="width:50px;" class="am-form-field" value="<?php echo substr($endtime,11,2)?>">
			</div>	
			<div class="am-u-sm-1 am-u-end">
				<input type="text" name="eminute" style="width:50px;" class="am-form-field" value="<?php echo substr($endtime,14,2)?>">
			</div>				
		</div>
		<div class="am-form-group am-form-group-sm">
			<label class="am-u-sm-2 am-form-label">Public:</label>
			<div class="am-u-sm-2">
				<select style="width:100px;">
					<option value="0" <?php echo $private=='0'?'selected=selected':''?>>Public</option>
					<option value="1" <?php echo $private=='1'?'selected=selected':''?>>Private</option>
				</select>
			</div>
			<div class="am-u-sm-8 am-u-end">
				<label class="am-u-sm-2 am-form-label">Language:</label>
				<select multiple style="width:180px;" name="lang[]">
					<?php
						$lang_count=count($language_ext);
						$lang=(~((int)$langmask))&((1<<$lang_count)-1);
						if(isset($_COOKIE['lastlang'])) $lastlang=$_COOKIE['lastlang'];
						 else $lastlang=0;
						 for($i=0;$i<$lang_count;$i++){
						               
						                 echo  "<option value=$i ".( $lang&(1<<$i)?"selected":"").">
						                        ".$language_name[$i]."
						                 </option>";
						  }

					?>
				</select>
			</div>
		</div>
		<div class="am-form-group am-form-group-sm">
			<label class="am-u-sm-2 am-form-label">problems:</label>
			<div class="am-u-sm-10 am-u-end" style="width:600px;">
				<input type="text" size="60" name="cproblem" value="<?php echo isset($plist)?$plist:""?>" class="am-form-field">
			</div>
		</div>
		<div class="am-form-group am-form-group-sm">
			<label class="am-u-sm-2 am-form-label">Description:</label>
			<?php
				$fck_description = new FCKeditor('description') ;
				$fck_description->BasePath = '../fckeditor/' ;
				$fck_description->Height = 300 ;
				$fck_description->Width=600;
				$fck_description->Value = $description ;
				$fck_description->Create() ;
			?>
		</div>
		<div class="am-form-group am-form-group-sm">
			<label class="am-u-sm-2 am-form-label">Users:</label>
			<div class="am-u-sm-10">
				<textarea name="ulist" rows="15" style="width:300px;"><?php if (isset($ulist)) { echo $ulist; } ?></textarea>
			</div>		
		</div>
		<div class="am-form-group am-form-group-sm" style="margin-bottom:80px;">
			<div class="am-u-sm-10 am-u-sm-offset-2">
				<input type="submit" value="Submit" name="submit" class="am-btn am-btn-success">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="Reset" name="reset" class="am-btn am-btn-primary">
			</div>			
		</div>
	</form>
</div>
<?php require_once("admin-footer");?>

