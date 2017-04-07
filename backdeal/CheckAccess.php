<?php
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include_once "CheckThisPathSession.php"; 
	include_once "ConnectDatabase.php";
	connect($_SESSION['homeid']);
	
	function checkAccess($id){
		$sql = "select * from t_access where username = '{$_SESSION['username']}'";
		$result = mysql_query($sql);
		$row = mysql_fetch_row($result);
		if($id == 21){
			$id = 12;
		}
		if($row[$id] == 1)
			return true;
		return false;
	}
?>