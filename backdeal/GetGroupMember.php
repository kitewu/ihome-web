<?php
	/*
	 *获得智能识别人员信息
	 */
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();

    include_once "CheckThisPathSession.php";
	include_once "ConnectDatabase.php";
	connect("ihome_global");
	
	$result = mysql_query("SELECT * FROM t_user where homeid = '{$_SESSION['homeid']}'");
	while($row = mysql_fetch_assoc($result)){
		$user[] = $row;
	}