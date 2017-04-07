<?php
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include_once "CheckThisPathSession.php"; 
	include_once "ConnectDatabase.php";
	include_once "Class.phpmailer.php";
	connect("ihome_global");
	
	$passwd = md5($_POST['Password']);
	$sql = "select * from t_homeid where homeid = '{$_SESSION['homeid']}' and password = '{$passwd}'";
	$result = mysql_query($sql);
	$row = mysql_fetch_row($result);
	if($row[0] == null){
		echo "密码错误";
		return;
	}
	else{//从数据库删除
		$sql = "select name from t_user where email = '{$_POST['Email']}'";
		$result = mysql_query($sql);
		$row = mysql_fetch_row($result);
		
		$sql = "delete from t_user where email = '{$_POST['Email']}'";
		mysql_query($sql);
		$sql = "delete from t_verify where email = '{$_POST['Email']}'";
		mysql_query($sql);
		
		mysql_select_db($_SESSION['homeid']);
		$sql = "delete from t_msgboard where fromuser = '{$row[0]}'";
		mysql_query($sql);
		
		$mail = new PHPMailer(true); 
		$mail->IsSMTP();
		$mail->CharSet='UTF-8'; 
		$mail->SMTPAuth   = true;
		$mail->Port       = 25;                    
		$mail->Host       = "smtp.126.com"; 
		$mail->Username   = "ihome999";    
		$mail->Password   = "ihome999";            
		$mail->IsSendmail(); 
		$mail->From       = "ihome999@126.com";
		$mail->FromName   = "ihome";
		$mail->AddAddress($_POST['Email']);
		$mail->Subject  = "账号注销";
		$mail->Body = "您的账号：".$_POST['Email']."已注销，操作人：".$_SESSION['username']."，操作时间 ：".date("Y-m-d H:i:s",time())."。爱家智能科技。";
		$mail->IsHTML(false); 
		if(!$mail->Send()){
			echo "删除失败";
			return;
		}
		echo "删除成功";
	}