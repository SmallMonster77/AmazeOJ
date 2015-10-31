<?php 
	$title="竞赛添加";
	include "admin-header.php";
	include "admin-main.php";
	require_once("../include/const.inc.php");
	require_once("../include/const.inc.php");
	$description="";
	 if (isset($_POST['syear']))
	{
		
		require_once("../include/db_info.inc.php");
		require_once("../include/check_post_key.php");
		
		$starttime=intval($_POST['syear'])."-".intval($_POST['smonth'])."-".intval($_POST['sday'])." ".intval($_POST['shour']).":".intval($_POST['sminute']).":00";
		$endtime=intval($_POST['eyear'])."-".intval($_POST['emonth'])."-".intval($_POST['eday'])." ".intval($_POST['ehour']).":".intval($_POST['eminute']).":00";
		//	echo $starttime;
		//	echo $endtime;

	        $title=$_POST['title'];
	        $private=$_POST['private'];
	        $description=$_POST['description'];
	        if (get_magic_quotes_gpc ()){
	                $title = stripslashes ($title);
	                $private = stripslashes ($private);
	                $description = stripslashes ($description);
	        }

		$title=mysql_real_escape_string($title);
		$private=mysql_real_escape_string($private);
		$description=mysql_real_escape_string($description);
		
	    $lang=$_POST['lang'];
	    $langmask=0;
	    foreach($lang as $t){
				$langmask+=1<<$t;
		} 
	$langmask=((1<<count($language_ext))-1)&(~$langmask);
		//echo $langmask;	
		
		$sql="INSERT INTO `contest`(`title`,`start_time`,`end_time`,`private`,`langmask`,`description`)
			VALUES('$title','$starttime','$endtime','$private',$langmask,'$description')";
	//	echo $sql;
		mysql_query($sql) or die(mysql_error());
		$cid=mysql_insert_id();
		echo "Add Contest ".$cid;
		$sql="DELETE FROM `contest_problem` WHERE `contest_id`=$cid";
		$plist=trim($_POST['cproblem']);
		$pieces = explode(",",$plist );
		if (count($pieces)>0 && strlen($pieces[0])>0){
			$sql_1="INSERT INTO `contest_problem`(`contest_id`,`problem_id`,`num`) 
				VALUES ('$cid','$pieces[0]',0)";
			for ($i=1;$i<count($pieces);$i++){
				$sql_1=$sql_1.",('$cid','$pieces[$i]',$i)";
			}
			//echo $sql_1;
			mysql_query($sql_1) or die(mysql_error());
			$sql="update `problem` set defunct='N' where `problem_id` in ($plist)";
			mysql_query($sql) or die(mysql_error());
		}
		$sql="DELETE FROM `privilege` WHERE `rightstr`='c$cid'";
		mysql_query($sql);
		$sql="insert into `privilege` (`user_id`,`rightstr`)  values('".$_SESSION['user_id']."','m$cid')";
		mysql_query($sql);
		$_SESSION["m$cid"]=true;
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
	}
	else{
		
	   if(isset($_GET['cid'])){
			   $cid=intval($_GET['cid']);
			   $sql="select * from contest WHERE `contest_id`='$cid'";
			   $result=mysql_query($sql) or die(mysql_error());
			   $row=mysql_fetch_object($result);
			   $title=$row->title;
			   mysql_free_result($result);
				$plist="";
				$sql="SELECT `problem_id` FROM `contest_problem` WHERE `contest_id`=$cid ORDER BY `num`";
				$result=mysql_query($sql) or die(mysql_error());
				for ($i=mysql_num_rows($result);$i>0;$i--){
					$row=mysql_fetch_row($result);
					$plist=$plist.$row[0];
					if ($i>1) $plist=$plist.',';
				}
				mysql_free_result($result);
	   }
	else if(isset($_POST['problem2contest'])){
		   $plist="";
		   //echo $_POST['pid'];
		   sort($_POST['pid']);
		   foreach($_POST['pid'] as $i){		    
				if ($plist) 
					$plist.=','.$i;
				else
					$plist=$i;
		   }
	}else if(isset($_GET['spid'])){
		require_once("../include/check_get_key.php");
			   $spid=intval($_GET['spid']);
			 
				$plist="";
				$sql="SELECT `problem_id` FROM `problem` WHERE `problem_id`>=$spid ";
				$result=mysql_query($sql) or die(mysql_error());
				for ($i=mysql_num_rows($result);$i>0;$i--){
					$row=mysql_fetch_row($result);
					$plist=$plist.$row[0];
					if ($i>1) $plist=$plist.',';
				}
				mysql_free_result($result);
			}
	}
	require_once("../fckeditor/fckeditor.php");
?>

<div class="admin-content">
	<div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">竞赛添加</strong></div>
    </div>    
	<form class="am-form am-form-horizontal" method="post">
		<div class="am-form-group am-form-group-sm">
			<label class="am-u-sm-2 am-form-label">title:</label>
			<div class="am-u-sm-10">
				<input type="text" name="title" style="width:300px;" class="am-form-field" value="<?php echo isset($title)?$title:""?>">
			</div>			
		</div>
		<div class="am-form-group am-form-group-sm">
			<label class="am-u-sm-3 am-form-label">Start Time(年-月-日-时-分):</label>
			<div class="am-u-sm-1">
				<input type="text" name="syear" style="width:50px;" class="am-form-field" value="<?php echo date('Y')?>">
			</div>
			<div class="am-u-sm-1">
				<input type="text" name="smonth" style="width:50px;" class="am-form-field" value="<?php echo date('m')?>">
			</div>	
			<div class="am-u-sm-1">
				<input type="text" name="sday" style="width:50px;" class="am-form-field" value="<?php echo date('d')?>">
			</div>	
			<div class="am-u-sm-1">
				<input type="text" name="shour" style="width:50px;" class="am-form-field" value="<?php echo date('H')?>">
			</div>	
			<div class="am-u-sm-1 am-u-end">
				<input type="text" name="sminute" style="width:50px;" class="am-form-field" value="00">
			</div>				
		</div>
		<div class="am-form-group am-form-group-sm">
			<label class="am-u-sm-3 am-form-label">End Time(年-月-日-时-分):</label>
			<div class="am-u-sm-1">
				<input type="text" name="eyear" style="width:50px;" class="am-form-field" value="<?php echo date('Y')?>">
			</div>
			<div class="am-u-sm-1">
				<input type="text" name="emonth" style="width:50px;" class="am-form-field" value="<?php echo date('m')?>">
			</div>	
			<div class="am-u-sm-1">
				<input type="text" name="eday" style="width:50px;" class="am-form-field" value="<?php echo date('d')+(date('H')+4>23?1:0)?>">
			</div>	
			<div class="am-u-sm-1">
				<input type="text" name="ehour" style="width:50px;" class="am-form-field" value="<?php echo (date('H')+4)%24?>">
			</div>	
			<div class="am-u-sm-1 am-u-end">
				<input type="text" name="eminute" style="width:50px;" class="am-form-field" value="00">
			</div>				
		</div>
		<div class="am-form-group am-form-group-sm">
			<label class="am-u-sm-2 am-form-label">Public:</label>
			<div class="am-u-sm-2">
				<select style="width:100px;">
					<option value="0">Public</option>
					<option value="1">Private</option>
				</select>
			</div>
			<div class="am-u-sm-8 am-u-end">
				<label class="am-u-sm-2 am-form-label">Language:</label>
				<select multiple style="width:180px;" name="lang[]">
					<?php
						$lang_count=count($language_ext);

						 $langmask=$OJ_LANGMASK;

						 for($i=0;$i<$lang_count;$i++){
						                 echo "<option value=$i selected>
						                        ".$language_name[$i]."
						                 </option>";
						  }

					?>
				</select>
				<?php 
					require_once("../include/set_post_key.php");				
				?>
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
				<textarea name="ulist" rows="15" style="width:300px;"></textarea>
			</div>		
		</div>
		<div class="am-form-group am-form-group-sm">
			<div class="am-u-sm-10 am-u-sm-offset-2">
				<span>*可以将学生学号从Excel整列复制过来，然后要求他们用学号做UserID注册,就能进入Private的比赛作为作业和测验。</span>
			</div>				
		</div>
		<div class="am-form-group am-form-group-sm" style="margin-bottom:80px;">
			<div class="am-u-sm-10 am-u-sm-offset-2">
				<input type="submit" value="Submit" name="submit" class="am-btn am-btn-success">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="Reset" name="reset" class="am-btn am-btn-primary">
			</div>			
		</div>
	</form>
</div>
<?php require_once("admin-footer.php") ?>