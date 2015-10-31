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
<header class="am-topbar-inverse am-topbar-fixed-top">
<div class="am-container">
  <h1 class="am-topbar-brand">
    <a href="index.php">HUSTOJ</a>
  </h1>

  <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-secondary am-show-sm-only"
            data-am-collapse="{target: '#collapse-head'}"><span class="am-sr-only">导航切换</span> <span
        class="am-icon-bars"></span></button>

  <div class="am-collapse am-topbar-collapse" id="collapse-head">
    <ul class="am-nav am-nav-pills am-topbar-nav">
      <li <?php if(basename($_SERVER['SCRIPT_NAME'])=="index.php"){echo "class='am-active'";} ?>><a href="index.php">首页</a></li>
      <li <?php if(basename($_SERVER['SCRIPT_NAME'])=="problemset.php"){echo "class='am-active'";} ?>><a href="problemset.php?page=1">题目</a></li>
      <li <?php if(basename($_SERVER['SCRIPT_NAME'])=="classify.php"){echo "class='am-active'";} ?>><a href="classify.php">分类</a></li>
      <li <?php if(basename($_SERVER['SCRIPT_NAME'])=="status.php"){echo "class='am-active'";} ?>><a href="status.php">状态</a></li>
      <li <?php if(basename($_SERVER['SCRIPT_NAME'])=="ranklist.php"){echo "class='am-active'";} ?>><a href="ranklist.php">排名</a></li>
      <li <?php if(basename($_SERVER['SCRIPT_NAME'])=="contest.php"){echo "class='am-active'";} ?>><a href="contest.php">比赛</a></li>
      <li <?php if(basename($_SERVER['SCRIPT_NAME'])=="discuss.php"){echo "class='am-active'";} ?>><a href="discuss.php">讨论</a></li>
    </ul>
    <?php
    if (!isset($_SESSION['user_id'])){
      echo <<<BOT
      <div class="am-topbar-right">
           <ul class="am-nav am-nav-pills am-topbar-nav">
            <li class="am-dropdown" data-am-dropdown>
              <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">登录<span class="am-icon-caret-down"></span>
                </a>
                <ul class="am-dropdown-content">
                  <li><a href="loginpage.php"><span class="am-icon-user"></span> 登录</a></li>
                  <li><a href="registerpage.php"><span class="am-icon-pencil"></span> 注册</a></li>
                </ul>
            </li>
          </ul>
    </div>
BOT;
    }else{
      echo <<<BOT
      <div class="am-topbar-right">
           <ul class="am-nav am-nav-pills am-topbar-nav">
            <li class="am-dropdown" data-am-dropdown>
              <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;"><span class="am-icon-user">用户中心<span class="am-icon-caret-down"></span>
                </a>
                <ul class="am-dropdown-content">
                  <li><a href="modifypage.php"><span class="am-icon-cog"></span> 信息修改</a></li>
                  <li><a href="userinfo.php?user={$_SESSION['user_id']}"><span class="am-icon-cog"></span> 数据统计</a></li>
                  <li><a href="#"><span class="am-icon-comments"></span> 留言</a></li>
                  <li><a href="logout.php"><span class="am-icon-history"></span> 注销</a></li>
BOT;
      if(isset($_SESSION['administrator'])){
        echo <<<BOT
          <li><a href="admin/index.php"><span class="am-icon-wrench"></span> 后台管理</a></li>
                  </ul>
              </li>
            </ul>
      </div>
BOT;
      }else{
        echo <<<BOT
                  </ul>
              </li>
            </ul>
      </div>
BOT;
      }
    }
    ?>
    
  </div>
</div>
</header>