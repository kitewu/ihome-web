<?php
	/*
	 *将设备状态更新到数据库
	 *发送socket消息到服务器
	 */
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include_once "CheckThisPathSession.php";
	include_once "ConnectDatabase.php";
	include_once "Socket.php";
	include_once "GetOperationID.php";
	include_once "CheckAccess.php";
	connect($_SESSION['homeid']);
	
	$deviceID = $_POST['deviceID'];
	
	$num = (int)$deviceID;
	if($num <= 11 || $num == 21){
		if(!checkAccess($num)){
			echo "操作失败，权限不允许";
			return;
		}
	}
	
	$stat = $_POST['deviceState'];	//修改状态
	if($stat == "true" || $state == "1"){
	    $stat = 1;
	}else{
	    $stat = 0;
	}
	$pre = "1/1/";
	$flag = false;
	switch($deviceID){
		case "0001" :
			if($stat == 1)
				$deviceID = "000101";
			$flag = true;
			break;
		case "0002" :
			if($stat == 1)
				$deviceID = "000201";
			$flag = true;
			break;
		case "0003" :
			if($stat == 1)
				$deviceID = "000301";
			$flag = true;
			break;
		case "0004" :
			if($stat == 1)
				$deviceID = "000401";
			$flag = true;
			break;
		case "0005" :
			if($stat == 1)
				$deviceID = "000501";
			$flag = true;
			break;
		case "0006" :
			if($stat == 1)
				$deviceID = "000601";
			$flag = true;
			break;
		case "0008" :
			if($stat == 1)
				$deviceID = "000801";
			$flag = true;
			break;
		case "0009" ://窗帘自动模式
			if($stat == 1)
				$deviceID = "000901";
			$flag = true;
			break;
		case "0010" ://智能模式
			if($stat == 1)
				$deviceID = "001001";
			$flag = true;
			break;
		case "0011" ://离家模式
			if($stat == 1)
				$deviceID = "001101";
			$flag = true;
			break;
		case "0012" ://门锁
			if($stat == 1)
				$deviceID = "001101";
			$flag = true;
			break;
	}
	
	//发送消息
	if(SendMsg($pre.$_SESSION['homeid']."/".$operation_msg_id[$deviceID]) != 1){
		echo "操作失败，请重试";
		return;
	}

	if($flag == true){
		//修改状态表
		$query="update t_device_stat set stat = '{$stat}' where id = '{$operation_type_id[$deviceID]}'";
		$result = mysql_query($query);
		if(!$result){
			echo "操作失败，请重试";
			return;
		}
	}
	
	//加入操作数据库
	$date = date("Y-m-d",time());
	$time = date("H:i:s",time());
	$query = "insert into t_operation (dates, times, types, operation) values('{$date}', '{$time}', '{$operation_type_id[$deviceID]}' , '{$operation_content[$deviceID]}')";
	$result = mysql_query($query);
	if(!$result){
		echo "操作失败，请重试";
		return;
	}
	echo "操作成功";
