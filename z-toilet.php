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
	</div>	<!--/.main-->
	<script>
		window.onload = function(){
			flush();
		};
		function flush(){
			var id = ['0005'];
			var state = [0];
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
		/*
		function flush(){
			var state = 0;
			if(document.getElementById('0005').checked == true){
				state = 1;
			}
			$.ajax( {
				type : "post",
				dataType : "json",
				url : './backdeal/GetSwitchStat.php',
				success : function(data) {
					var ui = document.getElementById("div_0005" + id[i]);
					if(data.flag[id[i]] == 1) {
						ui.style.display="";
						if (data.datas[id[i]] == 1)
							document.getElementById(id[i]).checked = true;
						else
							document.getElementById(id[i]).checked = false;
					}
					else
						ui.style.display="none";
					if(state != data.datas['0005']){
						if(state == 0)
							document.getElementById('0005').checked = true;
						else
							document.getElementById('0005').checked = false;
					}
				}
			});
		}*/
		window.setInterval(flush, 1000);//设置定时刷新
		function dealEvent(value) {
			alert(value);
			var state = document.getElementById(value).checked;
			$.post("./backdeal/SetState.php", {deviceID: value, deviceState: state},
				function(data) {
					alert(data);
				});
		}
	</script>
	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</body>

</html>
