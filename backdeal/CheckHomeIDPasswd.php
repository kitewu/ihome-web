<?php
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include_once "CheckThisPathSession.php"; 
	include_once "ConnectDatabase.php";
	connect("ihome_global");
	
	$passwd = md5($_POST['Password']);
	$sql = "select * from t_homeid where homeid = '{$_SESSION['homeid']}' and password = '{$passwd}'";
	$result = mysql_query($sql);
	$row = mysql_fetch_row($result);
	if($row[0] == null){
		echo "密码错误";
		return;
	}
	else{
		echo "验证成功";
		return;
	}
?>