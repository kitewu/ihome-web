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
<link href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/styles.css" rel="stylesheet">
</head>
<body>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">							
		<div class="row">
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<em class="glyphicon glyphicon-leaf glyphicon-l"></em>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div id="temperatrue" class="large">
							</div>
							<div class="text-muted">温度(℃)</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-orange panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<em class="glyphicon glyphicon-tint glyphicon-l"></em>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div id="humidity" class="large">
							</div>
							<div class="text-muted">湿度(%rh)</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<em class="glyphicon glyphicon-certificate glyphicon-l"></em>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div id="light" class="large">
							</div>
							<div class="text-muted">光照(lx)</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-red panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<em class="glyphicon glyphicon-bell glyphicon-l"></em>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div id="warnning" class="large">
							</div>
							<div class="text-muted">通知</div>
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
		//刷新函数
		function flush(){ 
			$.ajax( {
				type : "post",
				dataType : "json",
				url : './backdeal/GetData.php',       
				success : function(data) {       
					$('#temperatrue').empty();
					$('#temperatrue').append(data.temperature);
					$('#humidity').empty();
					$('#humidity').append(data.humidity);
					$('#light').empty();
					$('#light').append(data.light);
					$('#warnning').empty();
					$('#warnning').append(data.warnning);
				}
			});
		} 
		window.setInterval(flush, 1000); 
	</script>	
</body>

</html>
