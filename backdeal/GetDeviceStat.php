<?php
	/*
	 *获得设备基本状态，包括设备状态，设备名字，名字和id转换，id和名字转换
	 */
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include_once "CheckThisPathSession.php";
	include_once "ConnectDatabase.php";
	connect($_SESSION['homeid']);
	
	$query="select * from t_device_stat where flag = 1";
	$result = mysql_query($query);
	while($row = mysql_fetch_assoc( $result)){
		$StateData[$row['id']] = $row['stat'];
        $devicename[] = $row['device'];
        $devicename_and_id[$row['device']] = $row['id'];
        $deviceid_and_name[$row['id']] = $row['device'];
	}
