<?php
	error_reporting(E_ALL || ~E_NOTICE);
	include_once "ConnectDatabase.php";
	connect("ihome_global");

	/*检查格式*/
	$form = checkForm();
	if(null != $form){
		echo $form;
		return;
	}
	
	$homeid = $_POST['homeid'];
	$homeid_passwd = md5($_POST['homeid_passwd']);
	$verify = $_POST['verify'];
	$username = $_POST['username'];
	$phonenum = $_POST['phonenum'];
	$email = $_POST['email'];
	$passwd = md5($_POST['passwd']);

	/*验证homeid和密码*/
	$sql = "select * from t_homeid where homeid = '{$homeid}' and password = '{$homeid_passwd}'";
	$query = mysql_query($sql);
	$result = mysql_fetch_row($query);
	if(null == $result[0]){
		echo "注册失败，homeid验证错误，请重新验证";
		return;
	}
			
	/*验证邮箱是否已被注册*/
	$sql = "select mail, password from t_user where mail = '{$email}'";
	$query = mysql_query($sql);
	$result = mysql_fetch_row($query);
	if(null != $result[0]){//邮箱已被注册
		echo "注册失败，邮箱已被注册";
		return;
	}
	
	/*验证验证码*/
	if(!checkVerify($email, $verify)){
		echo "注册失败，验证码错误";
		return;
	}
	
	/*保存用户到全局数据库*/
	$sql = "insert into t_user (email, homeid, password, phonenumber, registertime, name)
						values ('{$email}', 
								'{$homeid}', 
								'{$passwd}', 
								'{$phonenum}', 
								  now(), 
								'{$username}')";
	/*保存用户到用户数据库中的权限控制*/
	$query = mysql_query($sql);
	if($query) {
		/*添加用户到权限列表*/
		connect($homeid);
		$sql = "inset into t_access values('{$username}', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1)";
		$query = mysql_query($sql);
		if($query) {
			echo "注册成功";
			deleteVerify($email);
		}
	} else {
		echo "注册失败";
	}
	
	/*验证验证码函数*/
	function checkVerify($email, $verify){
		$sql = "select * from t_verify where email = '{$email}' and verify = '{$verify}'";
		$query = mysql_query($sql);
		$result = mysql_fetch_row($query);
		if($result[0] != null)
			return true;
		return false;
	}
	
	/*删除验证码*/
	function deleteVerify($email){
		return mysql_query("delete from t_verify where email = '{$email}'");
	}
	
	/*检查格式*/
	function checkForm(){
		if($_POST['homeid'] == ""){
			return "homeid不能为空";
		}
		if($_POST['homeid_passwd'] == ""){
			return "hemeid密码不能为空";
		}
		if($_POST['email'] == ""){
			return "email不能为空";
		}
		if($_POST['verify'] == ""){
			return "验证码不能为空";
		}
		if($_POST['username'] == "" || strlen($_POST['username']) > 35){
			return "姓名长度不正确";
		}
		if($_POST['passwd'] == "" || strlen($_POST['passwd']) >= 20){
			return "密码长度不正确";
		}
		return null;
	}