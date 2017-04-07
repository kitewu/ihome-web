<?php
	/*
	 * 获得操作的id，操作类型id，操作内容等
	 */
    error_reporting(E_ALL || ~E_NOTICE);
    session_start();
    include_once "CheckThisPathSession.php";
    include_once "ConnectDatabase.php";
	connect($_SESSION['homeid']);
	$query="select * from t_operation_id";
	$result = mysql_query($query);
	while($row = mysql_fetch_assoc($result)){
		if($row['timingflag'] == 1)
			$timing[] = $row['operation'];
		$operation_msg_id[$row['id']] = $row['msg_id'];
		$operation_type_id[$row['id']] = $row['types'];
		$operation_content[$row['id']] = $row['operation'];
		$content_msg_id[$row['operation']] = $row['msg_id'];
	}