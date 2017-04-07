<?php 
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include_once "CheckThisPathSession.php";
	include_once "Socket.php";
	
	if('1' == SendMsg("1/1/".$_SESSION['homeid']."/21;00;01")){
		echo "操作成功";
	}else{
		echo "操作失败";
	}
