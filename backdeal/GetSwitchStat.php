<?php
    /*
     * 获得开关状态并返回
     */
    error_reporting(E_ALL || ~E_NOTICE);
    session_start();
    include_once "CheckThisPathSession.php";
    include_once "ConnectDatabase.php";
	connect($_SESSION['homeid']);
	
    $query="select * from t_device_stat ";
    $result = mysql_query($query);
    while($row = mysql_fetch_assoc( $result)) {
        $StateData[$row['id']] = $row['stat'];
        $DeviceFlag[$row['id']] = $row['flag'];
    }
	//获得亮度阈值
	$query="select light_min, light_max from t_temp_data";
    $result = mysql_query($query);
	$row = mysql_fetch_assoc($result);
	$light_min = $row['light_min'];
	$light_max = $row['light_max'];
	//获得温度阈值
	$query="select temp_min, temp_max from t_temp_data";
    $result = mysql_query($query);
	$row = mysql_fetch_assoc($result);
	$temp_min = $row['temp_min'];
	$temp_max = $row['temp_max'];
	echo json_encode(array('datas'=>$StateData,
                            'flag'=>$DeviceFlag,
						   'light_min'=>$light_min,
						   'light_max'=>$light_max,
						   'temp_max'=>$temp_max,
						   'temp_min'=>$temp_min
						   ));