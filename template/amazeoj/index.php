<?php $title="首页";?>
<?php 
	require_once("header.php");
	require_once('./include/db_info.inc.php');
?>
<div class="am-container" style="margin-top:40px;">
	<div class="am-panel am-panel-primary" id="accordion0">
		<div class="am-panel-hd" class="am-panel-title" data-am-collapse="{parent: '#accordion0', target: '#do-not-say-0'}">
			公告
		</div>
		<div id="do-not-say-0" class="am-panel-collapse am-collapse am-in">
			<div class="am-panel-bd">
				<div class="am-panel-group" id="accordion">	
				<div class="am-panel am-panel-danger">
					<div class="am-panel-hd" class="am-panel-title" data-am-collapse="{parent: '#accordion', target: '#do-not-say-1'}">
						【置顶】新版OJ已经上线
					</div>
					<div id="do-not-say-1" class="am-panel-collapse am-collapse am-in">
						<div class="am-panel-bd">
							<p style="color:red;">新版OJ已经上线，欢迎同学们测试使用，尽情的刷题吧！^_^</p>
						</div>
					</div>		
				</div>
			<?php
				$sql=	"SELECT * "
					."FROM `news` "
					."WHERE `defunct`!='Y'"
					."ORDER BY `importance` ASC,`time` DESC "
					."LIMIT 5";
				$result=mysql_query($sql);//mysql_escape_string($sql));
				if (!$result) {
					//没有公告
				}else{
					$i=2;
					while ($row=mysql_fetch_object($result)){
						echo <<<sss
						<div class="am-panel am-panel-danger">
							<div class="am-panel-hd" class="am-panel-title" data-am-collapse="{parent: '#accordion', target: '#do-not-say-$i'}">
								$row->title
							</div>
							<div id="do-not-say-$i" class="am-panel-collapse am-collapse">
								<div class="am-panel-bd">
									$row->content
								</div>
							</div>		
						</div>	
sss;
					$i++;
					}
					mysql_free_result($result);
				}
			?>		
			</div>
			</div>
			</div>
		</div>		
	</div>
</div>
<?php require_once("footer.php") ?>