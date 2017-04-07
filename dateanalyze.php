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
				<div class="navbar-brand"> IHOME </div>
				<div class="navbar-brand" style="float:right"><span class="glyphicon glyphicon-user"></span><?php echo " ".$_SESSION['username'] ?></div>
			</div>
		</div>
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<ul class="nav menu">
			<li><a href="status.php"><span class="glyphicon glyphicon-dashboard"></span> 状态</a></li>
			<li><a href="schema.php"><span class="glyphicon glyphicon-th-list"></span> 模式 </a></li>
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
			<li class="active"><a href="dateanalyze.php"><span class="glyphicon glyphicon-stats"></span> 数据分析</a></li>
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
				<li class="active">数据分析</li>
			</ol>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">数据分析</h1>
			</div>
		</div>
		<!--温度-->
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
							<h2><span class="glyphicon glyphicon-leaf"></span>温度</a></li></h2>
					</div>
					<div class="panel-body">
                        <div class="col-md-6">
                            <form role="form">
								<div class="row">
									<div class="form-group">
										<label> 开始时间</label>
										<input id="startdate_temperature" onchange="ChangePage('temperature')" 
											type="date" class="form-control" value="<?php echo date("Y-m-d",time());?>"/>
									</div>
									<div class="form-group">
										<label> 结束时间</label>
										<input id="enddate_temperature" onchange="ChangePage('temperature')" 
											type="date" class="form-control" value="<?php echo date("Y-m-d",time());?>"/>
									</div>
									<div id="div_slider_temperature" class="form-group">
										<input id="slider_temperature" onchange="RefreshChart('temperature')" 
											type="text" class="irs-hidden-input" value=""  readonly="" hidden="true"/>
									</div>
								</div>
                            </form>
                        </div>
                    </div>
					<div class="panel-body">
						<div id="div_chart_temperature" class="canvas-wrapper">
                            <canvas class="main-chart" id="line_chart_temperature" height="200" width="600"></canvas>
                        </div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		<!--湿度-->
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
							<h2><span class="glyphicon glyphicon-tint"></span>湿度</a></li></h2>
					</div>
					<div class="panel-body">
                        <div class="col-md-6">
                            <form role="form">
								<div class="row">
									<div class="form-group">
										<label> 开始时间</label>
										<input id="startdate_humidity" onchange="ChangePage('humidity')" 
											type="date" class="form-control" value="<?php echo date("Y-m-d",time());?>"/>
									</div>
									<div class="form-group">
										<label> 结束时间</label>
										<input id="enddate_humidity" onchange="ChangePage('humidity')" 
											type="date" class="form-control" value="<?php echo date("Y-m-d",time());?>"/>
									</div>
									<div id="div_slider_humidity" class="form-group">
										<input id="slider_humidity" onchange="RefreshChart('humidity')" 
											type="text" class="irs-hidden-input" value=""  readonly="" hidden="true"/>
									</div>
								</div>
                            </form>
                        </div>
                    </div>
					<div class="panel-body">
						<div id="div_chart_humidity" class="canvas-wrapper">
                            <canvas class="main-chart" id="line_chart_humidity" height="200" width="600"></canvas>
                        </div>
					</div>
				</div>
			</div>
		</div>					
		<!--亮度-->
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
							<h2><span class="glyphicon glyphicon-certificate"></span>光照</a></li></h2>
					</div>
					<div class="panel-body">
                        <div class="col-md-6">
                            <form role="form">
								<div class="row">
									<div class="form-group">
										<label> 开始时间</label>
										<input id="startdate_light" onchange="ChangePage('light')" 
											type="date" class="form-control" value="<?php echo date("Y-m-d",time());?>"/>
									</div>
									<div class="form-group">
										<label> 结束时间</label>
										<input id="enddate_light" onchange="ChangePage('light')" 
											type="date" class="form-control" value="<?php echo date("Y-m-d",time());?>"/>
									</div>
									<div id="div_slider_light" class="form-group">
										<input id="slider_light" onchange="RefreshChart('light')" 
											type="text" class="irs-hidden-input" value=""  readonly="" hidden="true"/>
									</div>
								</div>
                            </form>
                        </div>
                    </div>
					<div class="panel-body">
						<div id="div_chart_light" class="canvas-wrapper">
                            <canvas class="main-chart" id="line_chart_light" height="200" width="600"></canvas>
                        </div>
					</div>
				</div>
			</div>
		</div>	
	</div>	<!--/.main-->
	  
	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>

	<script src="plugins/ionslider/ion.rangeSlider.min.js"></script>
	<script src="plugins/bootstrap-slider/bootstrap-slider.js"></script>
	<script>
		window.onload = function(){
			ChangePage("temperature");
			ChangePage("humidity");
			ChangePage("light");
		};	//网页载入时触发
		var alldata_temp,alldata_humid,alldata_light;
		function RefreshChart(ele_name) {
			var threshold = document.getElementById("slider_"+ele_name).value.split(";");
			var x=new Array(),y=new Array();
			var i,j,alldata;
			
			if (ele_name == "temperature")
				alldata = alldata_temp;
			else if (ele_name == "humidity")
				alldata = alldata_humid;
			else if (ele_name == "light")
				alldata = alldata_light;
			
			for(i=threshold[0]-1,j=0;i<threshold[1];i++,j++) {
				x[j] = alldata.x[i];
				y[j] = alldata.y[i];
			}
			lineChartData = {
				labels : x,
				datasets : [
					{
						label: "My Second dataset",
						fillColor : "rgba(48, 164, 255, 0.2)",
						strokeColor : "rgba(148, 164, 255, 1)",
						pointColor : "rgba(48, 164, 255, 1)",
						pointStrokeColor : "#fff",
						pointHighlightFill : "#fff",
						pointHighlightStroke : "rgba(48, 164, 255, 1)",
						data : y
					},
				]
			}
			$('#div_chart_'+ele_name).empty();
			$('#div_chart_'+ele_name).append('<canvas class="main-chart" id="line_chart_'+ele_name+'" height="200" width="600"></canvas>');	//重新填充8
			chart = document.getElementById("line_chart_"+ele_name).getContext("2d");
			window.myLine = new Chart(chart).Line(lineChartData, {
				responsive: true
			});
		}
		function ChangePage(ele_name) {
			var start_time = document.getElementById("startdate_"+ele_name).value;
			var end_time = document.getElementById("enddate_"+ele_name).value;
			if (start_time>end_time) {
				alert("结束时间应在开始时间之后");
				start_time = document.getElementById("enddate_"+ele_name).value = 
				end_time = document.getElementById("startdate_"+ele_name).value;
				return;
			}
			$.ajax({
				type: "POST", 
				url : "./backdeal/GetHistoryDataToPC.php",
				data: {StartTime : start_time, EndTime : end_time, EleName : ele_name},
				dataType:'json',
				cache:false,
				success: function(data){
					if (ele_name == "temperature")
						alldata_temp = data;
					else if (ele_name == "humidity")
						alldata_humid = data;
					else if (ele_name == "light")
						alldata_light = data;
					$('#div_slider_'+ele_name).empty();	//清空此标签
					var str ="'"+ele_name+"'";
					$('#div_slider_'+ele_name).append('<input id="slider_'+ele_name+'" onchange="RefreshChart('+str+')" type="text" class="irs-hidden-input" hidden="true"/>');
					$(function () {
						/* ION SLIDER */
						$("#slider_"+ele_name).ionRangeSlider({
						  min: 1,
						  max: data.x.length,
						  from: 1,
						  to: data.x.length,
						  type: 'double',
						  step: 1,
						  prefix: "",
						  prettify: false,
						  hasGrid: true
						});
					});						
					
					lineChartData = {
						labels : data.x,
						datasets : [
							{
								label: "My Second dataset",
								fillColor : "rgba(48, 164, 255, 0.2)",
								strokeColor : "rgba(148, 164, 255, 1)",
								pointColor : "rgba(48, 164, 255, 1)",
								pointStrokeColor : "#fff",
								pointHighlightFill : "#fff",
								pointHighlightStroke : "rgba(48, 164, 255, 1)",
								data : data.y
							},
						]
					}
					$('#div_chart_'+ele_name).empty();
					$('#div_chart_'+ele_name).append('<canvas class="main-chart" id="line_chart_'+ele_name+'" height="200" width="600"></canvas>');	//重新填充8
					chart = document.getElementById("line_chart_"+ele_name).getContext("2d");
					window.myLine = new Chart(chart).Line(lineChartData, {
						responsive: true
					});
				}
			});  
		}
	</script>
	<script>
</body>
</html>

