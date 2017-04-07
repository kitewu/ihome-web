<?php
	/*
	 *获得设备操作历史记录
	 */
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include_once "CheckThisPathSession.php"; 
	include_once "ConnectDatabase.php";
	include_once "GetDeviceStat.php";
	connect($_SESSION['homeid']);
	
	$query="select * from t_operation";

	$startdate = $_GET['startdate'];
	$lastdate = $_GET['lastdate'];
	
	if( $_GET['devicename'] != "全部操作记录"){
		$query = $query." where types = '{$devicename_and_id[ $_GET['devicename']]}'";
	}
	else{
		$query = $query." where dates is not null ";
	}
	if($startdate != null or $lastdate != null){
		if($startdate == null){
			$startdate = '1970-01-01';
		}
		if($lastdate == null){
			$lastdate = date("Y-m-d", time());
		}
		$query = $query." and dates >=  '{$startdate}' and dates <=  '{$lastdate}'";
	}
	$result = mysql_query($query);
	$arrs = array();
	while($row = mysql_fetch_assoc($result)){
		$arrs[] = array("id"=>$row['homeid'], "date"=>$row['dates'], "time"=>$row['times'], "operation"=>$row['operation']);
	}
	echo json_encode($arrs);