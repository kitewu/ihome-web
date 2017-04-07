<?php
	/*
	 *获得温度，湿度，光照，留言，备忘录等信息，用于status界面刷新功能的数据获取
	 */
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include_once "CheckThisPathSession.php";
	include_once "ConnectDatabase.php";
	connect($_SESSION['homeid']);
	
	//获得温湿度灯历史数据
	$result = mysql_query("SELECT * FROM t_temp_data");
	while($row = mysql_fetch_assoc($result)){
		$temperature = $row['temperature'];
		$humidity = $row['humidity'];
		$light = $row['light'];
		$warnning = $row['warnning'];
	}

	//获得家庭留言板数据
	$result = mysql_query("SELECT * FROM t_msgboard order by date_time DESC");
	while($row = mysql_fetch_assoc($result)){
		$from[] = $row['fromuser'];
		$dates[] = $row['date_time'];
		$content[] = $row['content'];
	}
	
	//获得备忘录数据
	$result = mysql_query("SELECT note FROM t_note order by dates DESC");
	while($row = mysql_fetch_assoc($result)){
		$note[] = $row['note'];
	}
	//获得定时任务
	mysql_select_db("ihome_global");
	$result = mysql_query("SELECT * FROM t_timing where homeid = '{$_SESSION['homeid']}'");
	while($row = mysql_fetch_assoc($result)){
		if($row['frequency'] == 1){
			$m = "每天";
		}else{
			$m = "仅一次";
		}
		$t_frequency[] = $m;
		$t_operation[] = $row['operation'];
		$t_time[] = $row['hour'].":".$row['minute'];
	}
	
	echo json_encode(array(  'temperature'=>$temperature, 
							 'humidity'=>$humidity, 
							 'light'=>$light, 
							 'warnning'=>$warnning,
							 'from'=>$from,
							 'dates'=>$dates,
							 'content'=>$content,
							 'note'=>$note,
							 't_frequency'=>$t_frequency,
							 't_operation'=>$t_operation,
							 't_time'=>$t_time
							 ));
