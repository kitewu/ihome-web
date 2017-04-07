<?php
	/*
	 *添加家庭留言板
	 */
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include_ONCE "CheckThisPathSession.php"; 
	include_ONCE "ConnectDatabase.php";
	include_ONCE "Socket.php";
	connect($_SESSION['homeid']);
	
	if($_POST['Content'] == null){
		echo "内容不能为空";
		return;
	}
	if(strlen($_POST['Content']) > 480){
		echo "内容过长，请限制在160字以内！";
		return;
	}
	connect($_SESSION['homeid']);
	$sql="insert into t_msgboard(fromuser, date_time, content) values('{$_SESSION['username']}', now(),
	'{$_POST['Content']}')";
	$result = mysql_query($sql);
	if(!$result){
		echo "操作失败";
		return;
	}
	$msg = "1/2/".$_SESSION['homeid']."/消息来自 ".$_SESSION['username']." : ".$_POST['Content'];
	if(SendMsg($msg) != 1){
		echo "操作失败";
		return;
	}
	echo "添加成功";