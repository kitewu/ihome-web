<?php
	/*
	 *获得历史数据记录，温度，湿度，亮度
	 */
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include_once "CheckThisPathSession.php"; 
	include_once "ConnectDatabase.php";
	connect($_SESSION['homeid']);

	$flag = $_POST['Flag'];

	if($flag == 0 || $flag == 1)
		$mydate = $_POST['Date1'];//温度
	if($flag == 2)
		$mydate = $_POST['Date2'];//湿度
	if($flag == 3)
		$mydate = $_POST['Date3'];//亮度
	
	$query="select * from t_record where dates = '{$mydate}'";
	$result = mysql_query($query);
	
	$count_num = mysql_num_rows($result);	//数据条数
	$max_inter = 8;
	if($count_num>$max_inter)
		$step = ceil($count_num/$max_inter);
	else
		$step = 1;
	$inter=0;
	
	$i = 0;
	$c1 = 0;
	$c2 = 0;
	$c3 = 0;
	while($row = mysql_fetch_assoc($result)){
		if($inter == $step) {
			$value[$i] = $row['times'];
			if($flag == 0 || $flag == 1){
				$c1++;
				$temperature_value[$i] = $row['temperature'];
			}
			if($flag == 0 || $flag == 2){
				$c2++;
				$humidity_value[$i] = $row['humidity'];
			}
			if($flag == 0 || $flag == 3){
				$c3++;
				$light_value[$i] = $row['light'];
			}
			$i++;
			$inter = 0;
		}
		$inter++;
	}
	echo json_encode(array( 'value'=>$value,
							'temperature'=>$temperature_value, 
							'count1'=>$c1,
							'light'=>$light_value, 
							'count2'=>$c2,
							'humidity'=>$humidity_value, 
							'count3'=>$c3));