<?php
error_reporting(E_ALL || ~E_NOTICE);
session_start();
include_once "./backdeal/CheckSession.php";
include_once "./backdeal/GetDeviceStat.php";
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
	<link href="assets/css/add-ons.min.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link rel="stylesheet" href="plugins/ionslider/ion.rangeSlider.css">
	<link rel="stylesheet" href="plugins/ionslider/ion.rangeSlider.skinNice.css">

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
			<div class="navbar-brand"> IHOME</div>
			<div class="navbar-brand" style="float:right"><span class="glyphicon glyphicon-user"></span><?php echo " ".$_SESSION['username'] ?></div>
		</div>
	</div>
</nav>

<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
	<ul class="nav menu">
		<li><a href="status.php"><span class="glyphicon glyphicon-dashboard"></span> 状态</a></li>
		<li><a href="schema.php"><span class="glyphicon glyphicon-th-list"></span> 模式 </a></li>
		<li class="parent" class="active">
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
			<li class="active">家居控制</li>
		</ol>
	</div><!--/.row-->
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">家居控制</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<h2><table id="childrenlable1">客厅</table></h2>
		</div>

		<div class="col-md-12" id="div_0001">
			<div class="panel panel-default">
				<div class="panel-heading ">客厅灯</div>
				<div class="panel-body">
					<table class="table table-striped table-bordered bootstrap-datatable datatable">
						<tbody>
						<tr>
							<td>开关</td>
							<td>
								<label id="switch1" class="switch switch-success" >
									<?php
									$i = "0001";
									if($StateData[$i] == 1){
										echo '<input type="checkbox" id="'.$i.'"';
										echo ' class="switch-input" onclick="dealEvent(';
										echo "'".$i."'";
										echo ')" checked>';
									}
									else{
										echo '<input type="checkbox" id="'.$i.'"';
										echo ' class="switch-input" onclick="dealEvent(';
										echo "'".$i."'";
										echo ')">';
									}
									?>
									<span class="switch-label" data-on="On" data-off="Off"></span>
									<span class="switch-handle"></span>
								</label>
							</td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-12" id="div_0002">
			<div class="panel panel-default">
				<div class="panel-heading ">客厅空调</div>
				<div class="panel-body">
					<table class="table table-striped table-bordered bootstrap-datatable datatable">
						<tbody>
						<tr>
							<td>开关</td>
							<td>
								<label id="switch2" class="switch switch-success" >
									<?php
									$i = "0002";
									if($StateData[$i] == 1){
										echo '<input type="checkbox" id="'.$i.'"';
										echo ' class="switch-input" onclick="dealEvent(';
										echo "'".$i."'";
										echo ')" checked>';
									}
									else{
										echo '<input type="checkbox" id="'.$i.'"';
										echo ' class="switch-input" onclick="dealEvent(';
										echo "'".$i."'";
										echo ')">';
									}
									?>
									<span class="switch-label" data-on="On" data-off="Off"></span>
									<span class="switch-handle"></span>
								</label>
							</td>
						</tr>
						<tr>
							<td>温度</td>
							<td>
								<input type="button" onclick="dealEvent('000206')" id="000206" value="升高" class="btn btn-info">
								<input type="button" onclick="dealEvent('000207')" id="000207" value="降低" class="btn btn-info">
							</td>
						</tr>
						<tr>
							<td>风向</td>
							<td>
								<div data-toggle="buttons" class="btn-group">
									<label class="btn btn-info active" onclick="dealEvent('000212')" id="000212">
										<input type="radio">
										自动
									</label>

									<label class="btn btn-info" onclick="dealEvent('000213')" id="000213">
										<input type="radio">
										手动
									</label>
								</div>
							</td>
						</tr>
						<tr>
							<td>风速</td>
							<td>
								<div data-toggle="buttons" class="btn-group">
									<label class="btn btn-info active" onclick="dealEvent('000208')" id="000208">
										<input type="radio">
										自动
									</label>

									<label class="btn btn-info" onclick="dealEvent('000209')" id="000209">
										<input type="radio">
										一级
									</label>

									<label class="btn btn-info" onclick="dealEvent('000210')" id="000210">
										<input type="radio">
										二级
									</label>

									<label class="btn btn-info" onclick="dealEvent('000211')" id="000211">
										<input type="radio">
										三级
									</label>
								</div>
							</td>
						</tr>
						<tr>
							<td>模式</td>
							<td>
								<div data-toggle="buttons" class="btn-group">
									<label class="btn btn-info active" onclick="dealEvent('000214')" id="000214">
										<input type="radio">
										自动
									</label>

									<label class="btn btn-info" onclick="dealEvent('000202')" id="000202">
										<input type="radio">
										制冷
									</label>

									<label class="btn btn-info" onclick="dealEvent('000203')" id="000203">
										<input type="radio">
										除湿
									</label>

									<label class="btn btn-info" onclick="dealEvent('000204')" id="000204">
										<input type="radio">
										送风
									</label>

									<label class="btn btn-info" onclick="dealEvent('000205')" id="000205">
										<input type="radio">
										制暖
									</label>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								设置温度阈值<br>(17~30摄氏度)
							</td>
							<td>
								<p id="temp_td"></p>
								<input id="tempvalue1" type="text" style="width:60px" placeholder="min"></input>
								<input id="tempvalue2" type="text" style="width:60px" placeholder="max"></input>
								<button class="btn btn-primary btn-md" id="settemp" onclick="setTemp()">保存</button>
							</td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div><!--row-->

	<div class="row">
		<div class="col-lg-12">
			<h2><table id="childrenlable2">卧室</table></h2>
		</div>
		<div class="col-md-12" id="div_0004">
			<div class="panel panel-default">
				<div class="panel-heading ">卧室调光灯</div>
				<div class="panel-body">
					<table class="table table-striped table-bordered bootstrap-datatable datatable">
						<tbody>
						<tr>
							<td>开关</td>
							<td>
								<label id="switch4" class="switch switch-success" >
									<?php
									$i = "0004";
									if($StateData[$i] == 1){
										echo '<input type="checkbox" id="'.$i.'"';
										echo ' class="switch-input" onclick="dealEvent(';
										echo "'".$i."'";
										echo ')" checked>';
									}
									else{
										echo '<input type="checkbox" id="'.$i.'"';
										echo ' class="switch-input" onclick="dealEvent(';
										echo "'".$i."'";
										echo ')">';
									}
									?>
									<span class="switch-label" data-on="On" data-off="Off"></span>
									<span class="switch-handle"></span>
								</label>
							</td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-12" id="div_0003">
			<div class="panel panel-default">
				<div class="panel-heading ">卧室风扇</div>
				<div class="panel-body">
					<table class="table table-striped table-bordered bootstrap-datatable datatable">
						<tbody>
						<tr>
							<td>开关</td>
							<td>
								<label id="switch3" class="switch switch-success" >
									<?php
									$i = "0003";
									if($StateData[$i] == 1){
										echo '<input type="checkbox" id="'.$i.'"';
										echo ' class="switch-input" onclick="dealEvent(';
										echo "'".$i."'";
										echo ')" checked>';
									}
									else{
										echo '<input type="checkbox" id="'.$i.'"';
										echo ' class="switch-input" onclick="dealEvent(';
										echo "'".$i."'";
										echo ')">';
									}
									?>
									<span class="switch-label" data-on="On" data-off="Off"></span>
									<span class="switch-handle"></span>
								</label>
							</td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-12" id="div_0008">
			<div class="panel panel-default">
				<div class="panel-heading ">卧室窗帘</div>
				<div class="panel-body">
					<table class="table table-striped table-bordered bootstrap-datatable datatable">
						<tbody>
						<tr>
							<td>开关</td>
							<td>
								<label id="switch8" class="switch switch-success" >
									<?php
									$i = "0008";
									if($StateData[$i] == 1){
										echo '<input type="checkbox" id="'.$i.'"';
										echo ' class="switch-input" onclick="dealEvent(';
										echo "'".$i."'";
										echo ')" checked>';
									}
									else{
										echo '<input type="checkbox" id="'.$i.'"';
										echo ' class="switch-input" onclick="dealEvent(';
										echo "'".$i."'";
										echo ')">';
									}
									?>
									<span class="switch-label" data-on="On" data-off="Off"></span>
									<span class="switch-handle"></span>
								</label>
							</td>

						</tr>
						<tr>
							<td>智能调节室内亮度</td>
							<td>
								<label id="switch9" class="switch switch-success" >
									<?php
									$i = "0009";
									if($StateData[$i] == 1){
										echo '<input type="checkbox" id="'.$i.'"';
										echo ' class="switch-input" onclick="dealEvent(';
										echo "'".$i."'";
										echo ')" checked>';
									}
									else{
										echo '<input type="checkbox" id="'.$i.'"';
										echo ' class="switch-input" onclick="dealEvent(';
										echo "'".$i."'";
										echo ')">';
									}
									?>
									<span class="switch-label" data-on="On" data-off="Off"></span>
									<span class="switch-handle"></span>
								</label>
							</td>
						</tr>
						<tr>
							<td width="38%">
								阈值(0-1000)
							</td>
							<td id="light_td" width="62%">
							</td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div><!--row-->
	<div class="row">
		<div class="col-lg-12">
			<h2><table id="childrenlable3">厨房</table></h2>
		</div>
		<div class="col-md-12" id="div_0006">
			<div class="panel panel-default">
				<div class="panel-heading ">厨房灯</div>
				<div class="panel-body">
					<table class="table table-striped table-bordered bootstrap-datatable datatable">
						<tbody>
						<tr>
							<td>开关</td>
							<td>
								<label id="switch6" class="switch switch-success" >
									<?php
									$i = "0006";
									if($StateData[$i] == 1){
										echo '<input type="checkbox" id="'.$i.'"';
										echo ' class="switch-input" onclick="dealEvent(';
										echo "'".$i."'";
										echo ')" checked>';
									}
									else{
										echo '<input type="checkbox" id="'.$i.'"';
										echo ' class="switch-input" onclick="dealEvent(';
										echo "'".$i."'";
										echo ')">';
									}
									?>
									<span class="switch-label" data-on="On" data-off="Off"></span>
									<span class="switch-handle"></span>
								</label>
							</td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<h2><table id="childrenlable4">洗手间</table></h2>
		</div>
		<div class="col-md-12" id="div_0005">
			<div class="panel panel-default">
				<div class="panel-heading ">洗手间灯</div>
				<div class="panel-body">
					<table class="table table-striped table-bordered bootstrap-datatable datatable">
						<tbody>
						<tr>
							<td>开关</td>
							<td>
								<label id="switch5" class="switch switch-success" >
									<?php
									$i = "0005";
									if($StateData[$i] == 1){
										echo '<input type="checkbox" id="'.$i.'"';
										echo ' class="switch-input" onclick="dealEvent(';
										echo "'".$i."'";
										echo ')" checked>';
									}
									else{
										echo '<input type="checkbox" id="'.$i.'"';
										echo ' class="switch-input" onclick="dealEvent(';
										echo "'".$i."'";
										echo ')">';
									}
									?>
									<span class="switch-label" data-on="On" data-off="Off"></span>
									<span class="switch-handle"></span>
								</label>
							</td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="plugins/ionslider/ion.rangeSlider.min.js"></script>
<script src="plugins/bootstrap-slider/bootstrap-slider.js"></script>
<script>
	var light_value = "100;500";
	window.onload = function(){
		listenClickUpEvent();
		flush();
	};
	/*监听窗口的点击事件,鼠标点击结束时设置亮度阈值*/
	function listenClickUpEvent(){
		$(function(){
			document.onmouseup = function(event){
				if(event.button == 0){
					if(document.getElementById("lightvalue").value != light_value){
						light_value = document.getElementById("lightvalue").value;
						setLight();
					}
				}
			};
		});
	}
	/*实时刷新*/
	function flush(){
		var id = ['0001','0002','0003','0004','0005','0006','0008', '0009'];
		$.ajax( {
			type : "post",
			dataType : "json",
			url : './backdeal/GetSwitchStat.php',
			success : function(data) {
				for(var i = 0; i < id.length; i++){
					var ui = document.getElementById("div_" + id[i]);
					if(data.flag[id[i]] == 1) {
						ui.style.display="";
						if (data.datas[id[i]] == 1)
							document.getElementById(id[i]).checked = true;
						else
							document.getElementById(id[i]).checked = false;
					}
					else
						ui.style.display="none";
				}

				//重新填充温度阈值
				var temp_str = '  当前：摄氏度' + data.temp_min + "~" + data.temp_max + "。设置新的： ";
				$("#temp_td").empty();
				$("#temp_td").append(temp_str);

				//重新填充亮度阈值
				$("#light_td").empty();
				$("#light_td").append('<input hidden="true" class="irs-hidden-input" id="lightvalue" type="text" name="lightvalue" value="" readonly=""></input>');
				$(function () {
					$('.slider').slider();
					$("#lightvalue").ionRangeSlider({
						min: 0,
						max: 1000,
						from: data.light_min,
						to: data.light_max,
						type: 'double',
						step: 1,
						prefix: "",
						prettify: false,
						hasGrid: true
					});
				});
			}
		});
	}
	window.setInterval(flush, 2000);

	/*设置开关*/
	function dealEvent(value) {
		var state = document.getElementById(value).checked;
		$.post("./backdeal/SetState.php", {deviceID: value, deviceState: state},
			function(data) {
				alert(data);
			});
	}
	/*设置亮度阈值*/
	function setLight() {
		var values = document.getElementById("lightvalue").value.split(";");
		$.post("./backdeal/SetLight.php", {max: values[1], min: values[0]},
			function(data) {
			});
	}
	/*设置温度阈值*/
	function setTemp() {
		var value1 = document.getElementById("tempvalue1").value;
		var value2 = document.getElementById("tempvalue2").value;
		$.post("./backdeal/SetTemp.php", {max: value2, min: value1},
			function(data) {
				alert(data);
			});
	}
</script>

</body>
</html>

