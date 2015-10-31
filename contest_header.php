<!doctype html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title><?php echo $title?></title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="format-detection" content="telephone=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp"/>
  <link rel="alternate icon" type="image/png" href="assets/i/favicon.png">
  <link rel="stylesheet" href="assets/css/amazeui.min.css"/>
  <style type="text/css">
    .blog-footer {
      padding: 10px 0;
      text-align: center;
    }
  </style>
</head>
<body>
<?php 
    if(isset($_GET['cid']))
      $cid=intval($_GET['cid']);
    if (isset($_GET['pid']))
      $pid=intval($_GET['pid']);
?>
<header class="am-topbar-inverse am-topbar-fixed-top">
<div class="am-container">
  <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-secondary am-show-sm-only"
            data-am-collapse="{target: '#collapse-head'}"><span class="am-sr-only">导航切换</span> <span
        class="am-icon-bars"></span></button>
  <div class="am-collapse am-topbar-collapse" id="collapse-head">
    <ul class="am-nav am-nav-pills am-topbar-nav">
      <li <?php if(basename($_SERVER['SCRIPT_NAME'])=="index.php"){echo "class='am-active'";} ?>><a href="./">主页</a></li>
      <li <?php if(basename($_SERVER['SCRIPT_NAME'])=="contest.php"){echo "class='am-active'";} ?>><a href='./contest.php?cid=<?php echo $cid?>'>问题</a></li>
      <li <?php if(basename($_SERVER['SCRIPT_NAME'])=="contestrank.php"){echo "class='am-active'";} ?>><a href='./contestrank.php?cid=<?php echo $cid?>'>名次</a></li>
      <li <?php if(basename($_SERVER['SCRIPT_NAME'])=="status.php"){echo "class='am-active'";} ?>><a href='./status.php?cid=<?php echo $cid?>'>状态</a></li>
      <li <?php if(basename($_SERVER['SCRIPT_NAME'])=="conteststatistics.php"){echo "class='am-active'";} ?>><a href='./conteststatistics.php?cid=<?php echo $cid?>'>统计</a></li>
    </ul>
  </div>
</div>
</header>