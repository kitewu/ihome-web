<?php 
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include_once "./backdeal/GetDeviceStat.php";
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

<link href="css/bootstrap-table.css" rel="stylesheet">
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
			<li><a href="dateanalyze.php"><span class="glyphicon glyphicon-stats"></span> 数据分析</a></li>
			<li><a href="videosurveillance.php"><span class="glyphicon glyphicon-facetime-video"></span> 远程监控</a></li>
			<li class="active"><a href="history.php"><span class="glyphicon glyphicon-list-alt"></span> 历史记录</a></li>
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
				<li class="active">历史记录</li>
			</ol>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">历史记录</h1>
			</div>
		</div>

		<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">历史记录</div>
                    <div class="panel-body">
                        <div class="col-md-4">
                            <form role="form">
								<div class="row">
									<div class="form-group">
										<label>选择设备</label>
										<select id="select_devicename" class="form-control" onchange="ChangePage()">
										<?php
											echo "<option>"."全部操作记录"."</option>";
											$i = 0;
											$len = count($devicename);
											for($i = 0; $i < $len; $i++)
												echo "<option>".$devicename[$i]."</option>";
										?>
										</select>
									</div>     
								</div><!--/.row-->
                            </form>
                        </div>
						<div class="col-md-4">
                            <form role="form">
								<div class="row">
									<div class="form-group">
										<label> 开始时间</label>
										<input id="startdate" onchange="ChangePage()" type="date" class="form-control"/>
									</div>  
								</div><!--/.row-->
                            </form>
                        </div>
						<div class="col-md-4">
                            <form role="form">
								<div class="row">
									<div class="form-group">
										<label>结束时间</label>
										<input id="lastdate" onchange="ChangePage()" type="date" class="form-control"/>
									</div>
								</div><!--/.row-->
                            </form>
                        </div>									
						<div>
							<table id="TABLES" data-toggle="table" data-show-refresh="true" data-url="./backdeal/GetHistoryOperation.php" data-show-toggle="true" data-show-columns="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
								<thead>
								<tr>
									<th data-field="date"  data-sortable="true">日期</th>
									<th data-field="time" data-sortable="true">时间</th>
									<th data-field="operation" data-sortable="true">操作</th>
								</tr>
								</thead>
							</table>
						</div>
					</div>
					
                </div>
            </div><!-- /.col-->
        </div><!-- /.row -->
	</div>
	  
	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="js/bootstrap-table.js"></script>
	<script>
		window.onload = function(){
			ChangePage();
		};	//网页载入时触发
		function ChangePage() {
			var devicename = document.getElementById('select_devicename').value;
			var startdate = document.getElementById('startdate').value;
			var lastdate = document.getElementById('lastdate').value;
			var myurl = "./backdeal/GetHistoryOperation.php" + "?" + "devicename=" + "" + devicename + "" + "&" + "startdate=" + startdate + "&" + "lastdate=" + lastdate;
			$('#TABLES').bootstrapTable('refresh', {url: myurl});  
		}
	</script>
</body>
</html>

