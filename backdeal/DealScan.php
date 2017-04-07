<?php
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include_ONCE "CheckThisPathSession.php"; 
	include_ONCE "ConnectDatabase.php";
	connect($_SESSION[$_POST["homeid"]]);
	$id = $_POST["content"];
	$rr = mysql_query("select device from t_device_stat where id = '{$id}'");
	$dev = mysql_fetch_row($rr);
	if($dev[0] == null){
		$str = "操作失败";
	}else{
		$str = "success";
		//把状态表置1
		mysql_query("update t_device_stat set flag = 1 where id = '{$id}'");
		//定时任务表置1
		mysql_query("update t_operation_id set timingflag = 1 where id = '{$id}'");
	}
	echo $str;
?>