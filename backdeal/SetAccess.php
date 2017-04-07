<?php
	/*
	 *将设备状态更新到数据库
	 *发送socket消息到服务器
	 */
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include_once "CheckThisPathSession.php";
	include_once "ConnectDatabase.php";
	connect($_SESSION['homeid']);
	
	$access = $_POST['Access'];
	$state = $_POST['State'];
	if($state == "true" || $state == "1"){
	    $state = 1;
	}else{
	    $state = 0;
	}
	
	$arr = explode("/", $access);
	
	$num = 'a'.$arr[0];
	$sql = "update t_access set {$num} = {$state} where username = '{$arr[1]}'";
	$result = mysql_query($sql);
	if($result){
		echo "操作成功";
	}else{
		echo "操作失败";
	}
	
	
	