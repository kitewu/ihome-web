<?php
	include_once 'Class.phpmailer.php';
	include_once "ConnectDatabase.php";
	connect("ihome_global");

	if(sendMail($_POST['email']))
		echo "验证码发送成功，请注意查收";
	else
		echo "验证码发送失败";
	
	/*发送邮件*/
	function sendMail($to){
		try {
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
			$mail->AddAddress($to);
			$mail->Subject  = "注册验证";
			$verify = getVerify();
			$mail->Body = "您的验证码是：".$verify."。爱家智能科技。有效时间为十分钟";
			$mail->IsHTML(false); 
			if(!$mail->Send()){
				return false;
			}
			if(!saveVerify($to, $verify)){
				return false;
			}
			return true;
		}catch (phpmailerException $e) {
			return false;
		}
	}

	/*暂时保存验证码*/
	function saveVerify($email, $verify){
		return mysql_query("insert into t_verify (email, verify) values('{$email}', '{$verify}')");
	}
	
	/*随机数获得验证码*/
	function getVerify(){
		srand((double)microtime()*100000);
		return rand(100000, 999999);
	}
?>