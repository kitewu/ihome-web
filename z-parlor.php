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
			<div class="col-md-12"  id="div_0001">
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
	</div>	<!--/.main-->
	<script>
		window.onload = function(){
			flush();
		};
		function flush(){
			var id = ['0001','0002'];
			var state = [0,0];
			var i;
			for(i = 0; i < 2; i++){
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
					for(i = 0; i < 2; i++){
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
				}
			});
		}
		window.setInterval(flush, 1500);//设置定时刷新
		function dealEvent(value) {
			alert(value);
			var state = document.getElementById(value).checked;
			$.post("./backdeal/SetState.php", {deviceID: value, deviceState: state},
				function(data) {
					alert(data);
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
	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</body>

</html>
