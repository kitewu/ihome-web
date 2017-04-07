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
	$ele_name = $_POST['EleName'];

	$query="select dates,times,{$ele_name} from t_record where dates>='{$start_time}' and dates<='{$end_time}'";
	
	$result = mysql_query($query);
	$count_num = mysql_num_rows($result);
	if($count_num == 0) {
		$time_value[0] = "0";
		$temperature_value[0] = "0";
	}
	else {
		$max_inter = 50;
		if($count_num>$max_inter)
			$step = ceil($count_num/$max_inter);
		else
			$step = 1;
		
		$i=0;
		$inter=0;
		while($row = mysql_fetch_assoc($result)){
			if($inter == $step) {
				$time_value[$i] = $row['dates']." ".$row['times'];
				$temperature_value[$i] = $row[$ele_name];
				$i++;
				$inter = 0;
			}
			$inter++;
		}		
	}

	echo json_encode(array( 'x'=>$time_value,
							'y'=>$temperature_value));