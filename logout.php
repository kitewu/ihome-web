<?php
	/*
	 *退出销毁session
	 */
	require_once 'cs.php';
	echo '<img src="'._cnzzTrackPageView(1260107436).'" width="0" height="0"/>';
	error_reporting(E_ALL || ~E_NOTICE);
	$_SESSION = array();
	if(isset($_COOKIE[session_name()])) {
		setCookie(session_name(), '', time()-3600, '/');
	}
	session_destroy();
?>

<head>
	<title>下线</title>
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
			<form class="form-horizontal templatemo-container templatemo-login-form-1 margin-bottom-30">				
		        <div class="form-group">
		          <div class="col-xs-11">		            
		            <div class="control-wrapper">
						<center><font size="4" color="#FF0000">下线成功</font></center><br>
						<center><a href="./index.php"><font size="4" color="#00CD00"><u>重新登录</u></font></a></center>
		            </div>		            	            
		          </div>              
		        </div>
		      </form>
		</div>
	</div>
</body>
</html>