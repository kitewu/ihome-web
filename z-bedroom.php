<?php 
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include "./backdeal/CheckSession.php";
	include "./backdeal/GetDeviceStat.php";
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
									<td>
										当前值
									</td>
									<td id="light_value">
										<input id="lightvaluec1" type="text" style="width:60px" placeholder="" readonly></input>
										<input id="lightvaluec2" type="text" style="width:60px" placeholder="" readonly></input>
									</td>
								</tr>
								<tr>
									<td>
										设置阈值<br>(0-1000)
									</td>
									<td id="light_td">
										<input id="lightvalue1" type="text" style="width:60px" placeholder="min"></input>
										<input id="lightvalue2" type="text" style="width:60px" placeholder="max"></input>
										<button class="btn btn-primary btn-md" id="setlight" onclick="setLight()">保存</button>
									</td>
								</tr>
							</tbody>
						</table>        
					</div>
				</div>
			</div>
		</div><!--row-->
	</div>	<!--/.main-->
	<script>
		window.onload = function(){
			flush();
		};
		function flush(){
			var id = ['0003','0004','0008', '0009'];
			var state = [0,0,0,0];
			var i;
			for(i = 0; i < id.length; i++){
				if(document.getElementById(id[i]).checked == true){
					state[i] = 1;
				}
			}
			$.ajax( {
				type : "post",
				dataType : "json",
				url : './backdeal/GetSwitchStat.php',
				success : function(data) {
					var i;
					for(i = 0; i < id.length; i++){
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
					$("#light_value").empty();
					$("#light_value").append('<input id="lightvaluec1" type="text" style="width:60px" placeholder="' + data.light_min + '" readonly></input><input id="lightvaluec2" type="text" style="width:60px" placeholder="' + data.light_max + '" readonly></input>');
				}
			});
		}
		window.setInterval(flush, 2000);//设置定时刷新
		function dealEvent(value) {
			var state = document.getElementById(value).checked;
			$.post("./backdeal/SetState.php", {deviceID: value, deviceState: state},
				function(data) {
					alert(data);
				});
		}
		
		//设置亮度阈值
		function setLight() {
			var value1 = document.getElementById("lightvalue1").value;
			var value2 = document.getElementById("lightvalue2").value;
			$.post("./backdeal/SetLight.php", {max: value2, min: value1},
				function(data) {
				});
		}
	</script>
	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</body>

</html>
