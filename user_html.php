<?php if(!defined('APP')) die('error!'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>会员中心</title>
<style>
body{background-color:#eee;margin:0;padding:0;}
.box{width:400px;margin:15px;padding:20px;border:1px solid #ccc;background-color:#fff;}
.error-box{text-align:center;margin:15px;padding:10px;background:#FFF0F2;border:1px dotted #ff0099;font-size:14px;color:#ff0000;}
.error-box a{color:#0066ff;}
.box .title{font-size:20px;text-align:center;margin-bottom:20px;}
.box .welcome{text-align:center;}
.box .welcome a{color:#0066ff;}
.box .welcome span{color:#ff0000;}
</style>
</head>
<body>
<div class="box">
	<div class="title">会员中心</div>
	<?php if($login): ?>
		<div class="welcome">“<span><?php echo $userinfo['username']; ?></span>”您好，欢迎来到会员中心。<a href="?action=logout">退出</a></div>
		<!-- 此处编写会员中心其他内容 -->
	<?php else: ?>
		<div class="error-box">您还未登录，请先 <a href="login.php">登录</a> 或 <a href="register.html">注册新用户</a> 。</div>
	<?php endIf; ?>
</div>
</body>
</html>