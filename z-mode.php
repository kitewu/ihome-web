<?php 
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include "./backdeal/CheckSession.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>iHome</title>
<link href="assets/css/add-ons.min.css" rel="stylesheet">
<link href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/styles.css" rel="stylesheet">
</head>

<body>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<font size="5px"><span class="glyphicon glyphicon-cloud"></span>智能模式</a></li></font>
						<div style="float:right">
							<input type="button" id="0010" onclick="changeMode('0010')" class="btn btn-primary" value="">
						</div>
					</div>
					<div class="panel-body">
						<div class="col-md-6">
							<div class="panel panel-teal">
								<div class="panel-heading dark-overlay">智能人脸识别</div>
								<div class="panel-body">
									<p>当有人到访时，系统会检测当前人是否在成员库中，存在则推送人员信息到手机，否则推送信息为陌生人</p>
								</div>
							</div>
						</div>
						
						<!--div class="col-md-6">
							<div class="panel panel-teal">
								<div class="panel-heading dark-overlay">自动调节室内亮度</div>
								<div class="panel-body">
									<p>系统检测室内亮度，动态调节窗帘来调节室内亮度<br><br></p>
								</div>
							</div>
						</div><!--/.col-->
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<font size="5px"><span class="glyphicon glyphicon-lock"></span>离家模式</a></li></font>
						<div style="float:right">
							<input type="button" id="0011" onclick="changeMode('0011')" class="btn btn-primary" value="">
						</div>
					</div>
					<div class="panel-body">
						<div class="col-md-6">
							<div class="panel panel-teal">
								<div class="panel-heading dark-overlay">非法闯入报警</div>
								<div class="panel-body">
									<p>启动离家模式后，系统默认家中不允许有人，当检测到有人后，会发送通知到手机报警</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script>
		window.onload = function(){
			flush();
		};
		function flush(){
			var id = ['0010','0011'];
			$.ajax( {
				type : "post",
				dataType : "json",
				url : './backdeal/GetSwitchStat.php',
				success : function(data) {
					var i;
					for(var i = 0; i < id.length; i++){
						if(data.datas[id[i]] == 0)
							$("#"+id[i]).val("已关闭");
						else if(data.datas[id[i]] == 1)
							$("#"+id[i]).val("已开启");
					}
				}
			});
		}
		window.setInterval(flush, 1000);//设置定时刷新
	
		function changeMode(mode){
			var value = document.getElementById(mode).value;
			var stat;
			if(value == "已开启"){
				$("#" + mode).val("已关闭");
				stat = false;
			}else{
				$("#" + mode).val("已开启");
				stat = true;
			}
			$.ajax( {
				type : "post",
				url : './backdeal/SetState.php',       
				data : {deviceID : mode, deviceState : stat},
				success : function(data) {       
					alert(data);
				}
			});
		}
	</script>
</body>
</html>