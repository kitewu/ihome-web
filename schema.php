<?php 
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include_once "./backdeal/CheckSession.php";
	require_once 'cs.php';
	echo '<img src="'._cnzzTrackPageView(1260107436).'" width="0" height="0"/>';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>iHome</title>
<link href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/styles.css" rel="stylesheet">
</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class="navbar-brand"> IHOME </div>
				<div class="navbar-brand" style="float:right"><span class="glyphicon glyphicon-user"></span><?php echo " ".$_SESSION['username'] ?></div>
			</div>
		</div>
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<ul class="nav menu">
			<li><a href="status.php"><span class="glyphicon glyphicon-dashboard"></span> 状态</a></li>
			<li class="active"><a href="schema.php"><span class="glyphicon glyphicon-th-list"></span> 模式 </a></li>
			<li class="parent">
				<a href="control.php">
					<span class="glyphicon glyphicon-list"></span> 家居控制 <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span> 
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li>
						<a class="" href="control.php#childrenlable1">
							<span class="glyphicon glyphicon-th-large"></span> 客厅
						</a>
					</li>
					<li>
						<a class="" href="control.php#childrenlable2">
							<span class="glyphicon glyphicon-th-large"></span> 卧室
						</a>
					</li>
					<li>
						<a class="" href="control.php#childrenlable3">
							<span class="glyphicon glyphicon-th-large"></span> 厨房
						</a>
					</li>
					<li>
						<a class="" href="control.php#childrenlable4">
							<span class="glyphicon glyphicon-th-large"></span> 洗手间
						</a>
					</li>
				</ul>
			</li>
			<li><a href="dateanalyze.php"><span class="glyphicon glyphicon-stats"></span> 数据分析</a></li>
			<li><a href="videosurveillance.php"><span class="glyphicon glyphicon-facetime-video"></span> 远程监控</a></li>
			<li><a href="history.php"><span class="glyphicon glyphicon-list-alt"></span> 历史记录</a></li>
			<li><a href="intell_recognition.php"><span class="glyphicon glyphicon-eye-open"></span> 智能识别</a></li>
			<li><a href="media.php"><span class="glyphicon glyphicon-film"></span> 家庭影院</a></li>
			<li><a href="access.php"><span class="glyphicon glyphicon-user"></span> 权限管理</a></li>
			<li><a href="devicemanage.php"><span class="glyphicon glyphicon-plus-sign"></span> 设备管理</a></li>
			<li><a href="group.php"><span class="glyphicon glyphicon-user"></span> 家庭成员管理</a></li>
			<li role="presentation" class="divider"></li>
			<li><a href="logout.php"><span class="glyphicon glyphicon-remove-sign"></span> 退出登录</a></li>
		</ul>
	</div>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">		
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">模式</li>
			</ol>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">模式</h1>
			</div>
		</div>
		
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
		var id = -1;
		window.onload = function(){
			flush();
			setTimer();
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
		//设置定时刷新
		function setTimer(){
			id = window.setInterval(flush, 1000);
		}
		function changeMode(mode){
			window.clearInterval(id);
			var value = document.getElementById(mode).value;
			var stat;
			if(value == "已开启"){
				$("#" + mode).val("已关闭");
				stat = false;
			}else{
				$("#" + mode).val("已开启");
				stat = true;
			}
			$.post("./backdeal/SetState.php", {deviceID: mode, deviceState: stat},
				function(data) {
					alert(data);
				});
			setTimer();
		}
	</script>
</body>
</html>