<?php
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include_once "CheckThisPathSession.php"; 
	include_once "ConnectDatabase.php";
	include_once "Socket.php";
	connect($_SESSION['homeid']);
	
	if(!($_POST['max'] <= 30 && $_POST['min'] >= 17 && $_POST['min'] < $_POST['max'])){
		echo "参数设置不正确，请重新设置";
		return;
	}
	
	$sql = "update t_temp_data set temp_min = {$_POST['min']}, temp_max = {$_POST['max']}";
	$result = mysql_query($sql);
	if(!$result){
		echo "操作失败，请重试";
		return;
	}
	$msg = "1/8/".$_SESSION['homeid']."/".$_POST['min'].";".$_POST['max'];
	if(SendMsg($msg) != 1){
		echo "操作失败，请重试";
		return;
	}
	echo "操作成功";