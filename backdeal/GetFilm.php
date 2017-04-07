<?php
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include_once "CheckThisPathSession.php"; 	
	include_once "Socket.php";
	$msg = $_POST['dir'];
	$msg = str_replace("/",";",$msg);
	echo SendAndRecMsg("1/10/".$msg);