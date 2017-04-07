<?php
	/*
	 *删除一条备忘录
	 */
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include_ONCE "CheckThisPathSession.php"; 
	include_ONCE "ConnectDatabase.php";
	connect($_SESSION['homeid']);
	
	$sql = "update t_device_stat set flag = 0 where id = '{$_POST['ID']}'";
	$result = mysql_query($sql);
	if(!$result){
		echo "删除失败，请重试";
		return;
	}
	echo "删除成功";