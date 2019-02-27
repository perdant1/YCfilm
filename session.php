<?php
session_start();					//开启SESSION
$_SESSION['username'] = '小明';		//向SESSION添加数据（字符串）
$_SESSION['info'] = array(1,2,3);	//向SESSION添加数据（数组）
if(isset($_SESSION['test'])){		//判断SESSION中是否存在test
	$test = $_SESSION['test'];		//读取SESSION中的test
}
unset($_SESSION['username']);		//删除单个数据
$_SESSION = array();				//删除所有数据
session_destroy();					//结束当前会话