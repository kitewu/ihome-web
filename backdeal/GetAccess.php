<?php
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include_once "CheckThisPathSession.php";
	include_once "ConnectDatabase.php";
	connect("ihome_001");
	
	$result = mysql_query("SELECT * FROM t_access");
	while($row = mysql_fetch_row($result)){
		$data[] = $row;
	}	
	
	$result = mysql_query("SELECT * FROM t_device_stat order by id");
	while($row = mysql_fetch_row($result)){
		$device_name[] = $row[0];
	}	
?>