<?php
	/*
	 *获得智能识别人员信息
	 */
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();

    include_once "CheckThisPathSession.php";
	include_once "ConnectDatabase.php";
	connect($_SESSION['homeid']);
	
	$result = mysql_query("SELECT device, id FROM t_device_stat where flag = 1");
	while($row = mysql_fetch_assoc($result)){
		$devices[] = $row;
	}