<?php
	error_reporting(E_ALL || ~E_NOTICE);
	require_once 'cs.php';
	echo '<img src="'._cnzzTrackPageView(1260107436).'" width="0" height="0"/>';
	session_start();
	if (isset($_SESSION['isLogin'])) {
		unset($_SESSION['isLogin']);
	}
?>

<!DOCTYPE html>
<head>
	<title>登录</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/templatemo_style.css" rel="stylesheet" type="text/css">	
</head>
<body class="templatemo-bg-gray">
	<div class="container">
		<div class="col-md-12">
			<h1 class="margin-bottom-15">用户登录</h1>
			<form class="form-horizontal templatemo-container templatemo-login-form-1 margin-bottom-30">				
		        <div class="form-group">
		          <div class="col-xs-12">		            
		            <div class="control-wrapper">
		            	<label for="username" class="control-label fa-label"><i class="fa fa-user fa-medium"></i></label>
		            	<input type="text" class="form-control" id="id_username" placeholder="用户名">
		            </div>		            	            
		          </div>              
		        </div>
		        <div class="form-group">
		          <div class="col-md-12">
		          	<div class="control-wrapper">
		            	<label for="password" class="control-label fa-label"><i class="fa fa-lock fa-medium"></i></label>
		            	<input type="password" class="form-control" id="id_password" onkeypress="getKey();"placeholder="密码">
		            </div>
		          </div>
		        </div>
		        <div class="form-group">
		          <div class="col-md-12">
	             	<div class="checkbox control-wrapper">
	                	<label>
	                  		<input type="checkbox"> 记住我
                		</label>
	              	</div>
		          </div>
		        </div>
		        <div class="form-group">
		          <div class="col-md-12">
		          	<div class="control-wrapper">
		          		<input type="button" id="login" onclick="Checklogin()" value="登录" class="btn btn-info">
		          		<!--a href="forgot-password.php" class="text-right pull-right">忘记密码?</a-->
		          	</div>
		          </div>
		        </div>
		        <hr>
		        <div class="form-group">
		        	<!--div class="col-md-12">
		        		<label>快速登录:   </label>
		        		<div class="inline-block">
		        			<a href="#"><i class="fa fa-facebook-square login-with"></i></a>
		        		</div>		        		
		        	</div-->
		        </div>
		      </form>
		      <div class="text-center"> 
		      	<a href="create-account.php" class="templatemo-create-new"><font size='5'>注册</font><i class="fa fa-arrow-circle-o-right"></i></a>	
		      </div>
		</div>
	</div>
	
	<script>
		function getKey(){
			if (event.keyCode == 13){
				event.returnValue=false;
				event.cancel = true;
				var btn = document.getElementById('login');
				btn.focus();
				btn.click();
			}
		}
		function Checklogin() {	
			var username = document.getElementById('id_username').value;
			var password = document.getElementById('id_password').value;
			$.ajax({
				type:"POST",
				url:"./backdeal/CheckLogin.php",
				data:{Username: username, Password: password},
				data_type:"text",
				success: function(data){ 
					var arr = new Array();
					arr = data.split(';');
					if(arr[0] == "login_success"){
						window.location.href='status.php';
					}else{
						alert(data);
					}
				}
			});
		}
	</script>
	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</body>
</html>
