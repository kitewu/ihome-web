<?php
	/*
	 *获得下载任务的状态
	 */
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include_once "CheckThisPathSession.php";
	include_once "ConnectDatabase.php";
	connect($_SESSION['homeid']);
	
	$result = mysql_query("SELECT * FROM t_download_videos");
	while($row = mysql_fetch_assoc($result)){
		$needtime[] = $row['needtime'];
		$allsize[] = $row['allsize'];
		$downloadsize[] = $row['downloadsize'];
		$url[] = $row['url'];
		$speed[] = $row['speed'];
	}
	echo json_encode(array(  'needtime'=>$needtime, 
							 'allsize'=>$allsize, 
							 'downloadsize'=>$downloadsize, 
							 'url'=>$url,
							 'speed'=>$speed
							 ));
