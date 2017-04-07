<!DOCTYPE html>
<?php 
	require_once 'cs.php';
	echo '<img src="'._cnzzTrackPageView(1260107436).'" width="0" height="0"/>';
?>
<head>
	<title>注册</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/templatemo_style.css" rel="stylesheet" type="text/css">	
</head>
<body class="templatemo-bg-gray">
	<div class="container">
		<div class="col-md-12">	
			<h1 class="margin-bottom-10">注册账户</h1>
			<form class="form-horizontal templatemo-create-account templatemo-container">
				<div class="form-inner">
					<div class="form-group">
						<div class="col-md-6">		          	
							<label>HOMEID</label>
							<input type="text" class="form-control" id="id_homeid">
						</div>      
						<div class="col-md-6">		          	
							<label>密码</label>
							<input type="password" class="form-control" id="id_homeid_passwd">
						</div>
					</div>
					<div class="form-group">
			            <div class="col-md-6">		          	
							<label>邮箱</label>
							<input type="text" class="form-control" id="id_email" placeholder="">
						</div>  
					    <div class="col-md-6">
							<label>验证码</label>
							<div class="form-group">
								<div class="col-md-7">
									<input type="text" class="form-control" id="id_verify" placeholder="">	
								</div>
								<div class="col-md-3">
									<input type="button" value="获取验证码" onclick="sendVerify()" class="btn btn-info">
								</div>
							</div>
						</div>
			        </div>
					<div class="form-group">
			            <div class="col-md-6">		          	
							<label>姓名</label>
							<input type="text" class="form-control" id="id_username" placeholder="">
						</div>      
					    <div class="col-md-6">		          	
							<label>手机号（选填）</label>
							<input type="text" class="form-control" id="id_phonenum" placeholder="">
						</div>         
			        </div>
					
			        <div class="form-group">
						<div class="col-md-6">
							<label>密码(6~20)</label>
							<input type="password" class="form-control" id="id_passwd" placeholder="">
						</div>   
						<div class="col-md-6">
							<label>确认密码</label>
							<input type="password" class="form-control" id="id_passwd_confirm" placeholder="">
						</div>
			        </div>	
					
			        <div class="form-group">
						<div class="col-md-12">
							<a href="index.php"><font size="5">登录</size></a>
							<input type="button" onclick="createNewAccount()" value="创建账户" class="btn btn-info pull-right">
						</div>
			        </div>
				</div>
		    </form>		      
		</div>
	</div>
	<script>
		/*
		window.onload = function(){//初始化短信服务
			Bmob.initialize("", "");
		};	 
		function send(){
			Bmob.initialize("", "");
			var phonenum = document.getElementById('id_phonenum').value;
			Bmob.Sms.requestSmsCode({"mobilePhoneNumber": phonenum} ).then(function(obj) {
			  alert("发送成功"); //
			}, function(err){
			  alert("发送失败:"+err);
			});
		}
		*/
		/*发送验证码*/
		function sendVerify(){
			var email = document.getElementById('id_email').value;
			if(email == ""){
				alert("email不能为空");
				return;
			}
			$.ajax({
				type:"POST",
				url:"./backdeal/Mailer.php",
				data:{email: email},
				data_type:"text",
				success: function(data){ 
					alert(data);
				}
			});
		}
		/*创建用户*/
		function createNewAccount() {
			var homeid = document.getElementById('id_homeid').value;
			var homeid_passwd = document.getElementById('id_homeid_passwd').value;
			var email = document.getElementById('id_email').value;
			var verify = document.getElementById('id_verify').value;
			var username = document.getElementById('id_username').value;
			var phonenum = document.getElementById('id_phonenum').value;
			var passwd = document.getElementById('id_passwd').value;
			var passwd_confirm = document.getElementById('id_passwd_confirm').value;
			if(homeid == ""){
				alert("homeid不能为空");
				return;
			}
			if(homeid_passwd == ""){
				alert("hemeid密码不能为空");
				return;
			}
			if(email == ""){
				alert("email不能为空");
				return;
			}
			if(verify == ""){
				alert("验证码不能为空");
				return;
			}
			if(username == ""){
				alert("姓名不能为空");
				return;
			}
			if(passwd == ""){
				alert("密码不能为空");
				return;
			}
			if(passwd != passwd_confirm){
				alert("密码不一致");
				return;
			}
			$.ajax({
				type:"POST",
				url:"./backdeal/SaveNewUser.php",
				data:{	homeid : homeid, 
						homeid_passwd : homeid_passwd, 
						email: email, 
						verify: verify,
					    username: username, 
					    phonenum: phonenum,
						passwd: passwd
					},
				data_type:"text",
				success: function(data){ 
					alert(data);
					if(data == "注册成功"){
						window.location.href='index.php';
					}
				}
			});
			/*
			Bmob.initialize("", "");
			var verify = document.getElementById('id_verify').value;
			Bmob.Sms.verifySmsCode(phonenum, verify).then(function(obj) {
			}, function(err){
			    alert("验证错误");
			});
			*/
		}
	</script>
	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</body>
</html>