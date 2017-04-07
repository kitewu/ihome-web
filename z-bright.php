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
	<!--温度-->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2><span class="glyphicon glyphicon-leaf"></span>亮度</a></li></h2>
				</div>
				<div class="panel-body">
					<div class="col-md-6">
						<form role="form">
							<div class="row">
								<div class="form-group">
									<label> 选择时间</label>
									<input id="startdate1" onchange="ChangePage(3)" type="date" class="form-control" value="<?php echo date('Y-m-d',time());?>"/>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="panel-body">
					<div id="DivChartContainer3" class="canvas-wrapper">
						<canvas class="main-chart" id="line-chart3" height="200" width="600"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div><!--/.row-->
</div>	<!--/.main-->
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="js/chart.min.js"></script>
<script src="js/chart-data.js"></script>
<script>
	window.onload = function(){
		ChangePage(0);
	};	//网页载入时触发
	function ChangePage(flag) {
		var date1 = document.getElementById("startdate1").value;
		$.ajax({
			type: "POST",
			url : "./backdeal/GetHistoryData.php",
			data: {Date3 : date1,Flag : flag},
			dataType:'json',
			cache:false,
			success: function(data){
				if(flag == 3 || flag == 0){
					if(data.count3 == 0){
						$('#DivChartContainer3').empty();	//清空此标签
						$('#DivChartContainer3').append('<h1>无数据</h1>');
					}else{
						lineChartData = {
							labels : data.value,
							datasets : [
								{
									label: "My Second dataset",
									fillColor : "rgba(48, 164, 255, 0.2)",
									strokeColor : "rgba(148, 164, 255, 1)",
									pointColor : "rgba(48, 164, 255, 1)",
									pointStrokeColor : "#fff",
									pointHighlightFill : "#fff",
									pointHighlightStroke : "rgba(48, 164, 255, 1)",
									data : data.light
								},
							]
						}
						$('#DivChartContainer3').empty();
						$('#DivChartContainer3').append('<canvas class="main-chart" id="line-chart3" height="200" width="600"></canvas>');	//重新填充8
						chart = document.getElementById("line-chart3").getContext("2d");
						window.myLine = new Chart(chart).Line(lineChartData, {
							responsive: true
						});
					}
				}
			}
		});
	}
</script>
</body>
</html>

