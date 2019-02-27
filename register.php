<?php

//设定字符集
header('Content-Type:text/html;charset=utf-8');

$error = array();	//保存错误信息

//封装函数：载入HTML模板文件
function showRegPage(){

	$error = $GLOBALS['error'];//从全局变量读取错误信息
	
	define('APP','itcast');
	require 'register_html.php';

	die;  //终止程序继续执行
}

//没有表单提交时，显示注册页面
if(empty($_POST)){
	showRegPage();
}

//执行到此处说明有表单提交

//判断表单中各字段是否都已填写
$check_fields = array('username','password','email');
foreach($check_fields as $v){
	if(empty($_POST[$v])){
		$error[] = '错误：'.$v.'字段不能为空！';
	}
}
if(!empty($error)){
	showRegPage();  //显示错误信息并停止程序
}

//连接数据库，设置字符集，选择数据库
mysql_connect('localhost','root','') or die('数据库连接失败！');
mysql_query('set names utf8');
mysql_query('use `itcast`') or die('itcast数据库不存在！');

//接收需要处理的表单字段
$username = trim($_POST['username']);
$password = $_POST['password'];
$email = trim($_POST['email']);

//载入表单验证函数库，验证用户名和密码格式
// require '../example18/check_form.lib.php';
// if(($result = checkUsername($username)) !== true)  $error[] = $result;
// if(($result = checkPassword($password)) !== true)  $error[] = $result;
// if(($result = checkEmail($email)) !== true)  $error[] = $result;
if(!empty($error)){
	showRegPage();  //显示错误信息并停止程序
}

//SQL转义
$username = mysql_real_escape_string($username);
$email = mysql_real_escape_string($email);

//判断用户名是否存在
$sql = "select `id` from `user` where `username`='$username'";
$rst = mysql_query($sql);
if(mysql_fetch_row($rst)){
	$error[] = '用户名已经存在，请换个用户名。';
	showRegPage();  //显示错误信息并停止程序
}

//提升密码安全
$password = md5($password);

//拼接SQL语句
$sql = "insert into `user` (`username`,`password`,`email`) values ('$username','$password','$email')";

//执行SQL语句
$rst = mysql_query($sql);

if($rst){

	//用户注册成功，自动登录
	session_start();
	
	//获取新注册用户的ID
	$id = mysql_insert_id();
	
	$_SESSION['userinfo'] = array(
		'id' => $id,				//将用户id保存到SESSION
		'username' => $username		//将用户名保存到SESSION
	);

	//注册成功，自动跳转到会员中心
	echo '<script>alert("注册成功！");window.location.href="user.php"; </script>';
	die;
}else{
	$error[] = '注册失败，数据库操作失败。';
	showRegPage();  //显示错误信息并停止程序
}
