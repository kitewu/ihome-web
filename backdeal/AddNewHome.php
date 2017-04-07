<?php
	include_ONCE "Face.class.php";
	
	$name = "ihome_003";
	$passwd = md5("123456");
	$api_key = 'b68340946ae8e52bd5ae95442b994405';
	$api_secret = 'znG4oojNL1l-Ic3GV5_F_FuTQQC6KCiw';
	
	//创建数据库
	$link = mysql_connect("localhost", "root", "wsl!@#123");
	if(!$link){
		echo mysql_error()."\n";
		return;
	}
	mysql_query('set names utf8');
	
	$sql = "create database ".$name;
	if(!mysql_query($sql, $link)){
		echo mysql_error()."\n";
		return;
	}
	
	//添加信息到homeid表
	mysql_select_db("ihome_global");
	$sql = "insert into t_homeid values('{$name}', '{$passwd}')";
	if(!mysql_query($sql, $link)){
		echo mysql_error()."\n";
		return;
	}
		
	//创建数据表

	//创建facepp group
	$api = new FacePPClient($api_key, $api_secret);	
	$result = $api->group_create($name);
	if(!empty($result['error'])){
		print_r($result);
		return;
	}
	
	echo "success";
	