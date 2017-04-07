<?php 
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	if (isset($_SESSION['isLogin'])) {
		unset($_SESSION['isLogin']);
	}
	
	include_once 'ConnectDatabase.php';
	connect("ihome_global");
	$select_sql = "SELECT * FROM t_user WHERE email = '{$_POST['Username']}'";
	$query=mysql_query($select_sql);
	$result=mysql_fetch_array($query, MYSQL_ASSOC);
	if($result['email'] != ""){
		if($result['password'] == md5($_POST['Password'])){
			$_SESSION['isLogin'] = true;
			$_SESSION['username'] = $result['name'];
			$_SESSION['phonenum'] = $result['phonenumber'];
			$_SESSION['homeid'] = $result['homeid'];
			echo "login_success".";".$result['name'].";".$_SESSION['homeid'];
		}else{    
			echo "密码错误";
		}
	}else{
		echo "用户不存在";
	}

