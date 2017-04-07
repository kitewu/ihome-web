<?php
	/*
	 *获得历史数据记录，温度
	 */
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include_once "CheckThisPathSession.php"; 
	include_once "ConnectDatabase.php";

	connect($_SESSION['homeid']);
	$start_time = $_POST['StartTime'];
	$end_time = $_POST['EndTime'];


	$query="select dates,times,temperature from t_record where dates>='{$start_time}' and dates<'{$end_time}'";
	
	$result = mysql_query($query);
	$count_num = mysql_num_rows($result);	//数据条数
	$max_inter = 20;
	if($count_num>$max_inter)
		$step = floor($count_num/$max_inter);
	else
		$step = 1;
	
	$i=0;
	$inter=$step;
	while($row = mysql_fetch_assoc($result)){
		if($inter == $step) {
			$time_value[$i] = $row['dates']." ".$row['times'];
			$temperature_value[$i] = $row['temperature'];
			$i++;
			$inter = 0;
		}
		$inter++;
	}

	echo json_encode(array( 'x'=>$time_value,
							'y'=>$temperature_value));