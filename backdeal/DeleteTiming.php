<?php
	/*
	 *删除一条定时任务
	 */
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include_once "CheckThisPathSession.php"; 
	include_once "ConnectDatabase.php";
	include_once "Socket.php";
	include_once "GetOperationID.php";
	connect("ihome_global");
	
	$arr = explode(":", $_POST['time']);
	if($_POST['frequency'] == "仅一次")
		$m = 0;
	else
		$m = 1;
	$mm = $content_msg_id[$_POST['operation']];
	$msg = "1/6/".$_SESSION['homeid']."/".$mm."&".$m."&".$arr[0]."&".$arr[1];
	if(SendMsg($msg) != 1){
		echo "操作失败，请重试";
		return;
	}
	$sql = "delete from t_timing where homeid = '{$_SESSION['homeid']}' and frequency='{$m}' and hour={$arr[0]} and operation = '{$_POST['operation']}' and minute={$arr[1]}";
	$result = mysql_query($sql);
	if(!$result){
		echo "操作失败，请重试";
	}
	echo "操作成功";