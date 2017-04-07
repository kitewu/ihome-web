<?php 

	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include_once "CheckThisPathSession.php";
	include_once "Socket.php";
	
	if($_POST['data'] == "http、ftp下载链接"){
		echo "地址不正确";
		return; 
	}
	$result = SendMsg("1/11/".$_SESSION['homeid']."/".$_POST['data']);
	if($result != "1"){
		echo "操作失败";
		return;
	}
	echo "操作成功";
	