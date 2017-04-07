<?php
	/*
	 *将设备状态更新到数据库
	 *发送socket消息到服务器
	 */
	
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include_once "CheckThisPathSession.php";
	include_once "Socket.php";
	include_once "GetOperationID.php";
	include_once "ConnectDatabase.php";
	connect("ihome_global");
	
	if($_POST['frequency'] == "仅一次"){
		$frequency = 0;//仅一次
	}else{
		$frequency = 1;//每天
	}
	$m = $content_msg_id[$_POST['operation']];
	$sql = "select  hour from t_timing where homeid = '{$_SESSION['homeid']}' and frequency = {$frequency} and hour = {$_POST['hour']} and minute = {$_POST['minute']} and msg = '{$m}'";
	$result = mysql_query($sql);
	while($row = mysql_fetch_assoc($result)){
		if($row['hour'] != null){
			echo "任务已存在";
			return;
		}
	}
	
	$msg = "1/5/".$_SESSION['homeid']."/".$m."&".$frequency."&".$_POST['hour']."&".$_POST['minute'];
	if(SendMsg($msg)!=1){
		echo "操作失败，请重试";
		return;
	}
	$sql = "insert into t_timing values('{$_SESSION['homeid']}', {$frequency}, {$_POST['hour']}, {$_POST['minute']}, '{$m}','{$_POST['operation']}')";
	if(!mysql_query($sql)){
		echo "操作失败，请重试2";
		return;
	}
	echo "操作成功";
