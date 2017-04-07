<?php
	/*
	 *添加一条备忘录
	 */
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include_ONCE "CheckThisPathSession.php"; 
	include_ONCE "ConnectDatabase.php";
	connect($_SESSION['homeid']);
	
	if($_POST['Note'] == null){
		echo "内容不能为空";
		return;
	}
	if(strlen($_POST['Note']) > 120){
		echo "内容过长，请限制在40字以内！";
		return;
	}
	$sql = "insert into t_note(note, dates) values('{$_POST['Note']}', now())";
	$result = mysql_query($sql);
	if(!$result){
		echo "操作失败";
		return;
	}
	echo "添加成功";