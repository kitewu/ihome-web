<?php 
	/*
	 *检查你用户名是否存在
	 *用户存在且密码匹配，登录成功
	 *返回登陆成功信息
	 */
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	if (isset($_SESSION['isLogin'])) {
		unset($_SESSION['isLogin']);    //注销已注册内容
	}

	$link = mysql_connect("localhost", "root", "wsl!@#123");
	mysql_select_db("ihome_global");
	mysql_query('set names utf8');

	$select_sql = "SELECT * FROM t_user WHERE email = '{$_GET['Username']}'";
	$query=mysql_query($select_sql);
	$result=mysql_fetch_array($query, MYSQL_ASSOC);
	
	$select_sql = "SELECT * FROM t_user WHERE email = '{$_GET['Username']}'";
	$query=mysql_query($select_sql);
	$result=mysql_fetch_array($query, MYSQL_ASSOC);
	if($result['email'] != ""){ //用户存在
		$password = md5($_GET['Password']);
		$user_pwd = $result['password'];
		if($user_pwd == $password){  //用户名和密码匹配，登陆成功
			$_SESSION['isLogin'] = 1;
			$_SESSION['username'] = $result['name'];
			$_SESSION['phonenum'] = $result['phonenumber'];
			$_SESSION['homeid'] = $result['homeid'];
			echo "login_success".";".$result['name'].";".$_SESSION['homeid'];
		}else{    //否则登录失败
			echo "用户名或密码错误";
		}
	}else{ //用户不存在
		echo "用户不存在";
	}

