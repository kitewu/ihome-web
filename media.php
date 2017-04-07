<?php 
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include "./backdeal/CheckSession.php";
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
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
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
			<li class="parent" >
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
			<li class="active"><a href="media.php"><span class="glyphicon glyphicon-film"></span> 家庭影院</a></li>
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
				<li class="active">家庭影院</li>
			</ol>
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">家庭影院</h1>
			</div>
		</div>
			<div class="row">			
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<font id="head" size="5px"></font>
							<button style='float:right' onclick="back()" class="btn btn-primary">返回上一级</button>
						</div>	
						<div class="panel-body">
							<table id="dic_table" class="table table-striped table-bordered bootstrap-datatable datatable"> 
							</table>        
						</div>
					</div>
				</div>
			</div>
		<div class="row">			
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading ">
							<font size="5px">远程下载</font>
					</div>
					<div class="panel-body">
						<div class="input-group">
							<input id="url" class="form-control" placeholder="http、ftp下载链接">

							<div class="input-group-btn">
							  <button onclick="newFilm()" type="button" class="btn btn-primary btn-md"><i class="fa fa-plus"></i></button>
							</div>
						</div>
					</div>
					<div id="download_film" class="panel-body">
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		var currentpath = "usb";
		var candownload = true;
		var dircount = 0;
		var obj = document.getElementById("head");
		window.onload = function(){
			getDownload();
			getList("-1");
		};
		
		//播放
		function playFilm(id){
			var dir = '1' + currentpath + "/" + document.getElementById(id).innerText;
			$.ajax( {
				type : "post",
				dataType : "text",
				url : './backdeal/ManageFilm.php',
				data : {dir : dir},
				success : function(data) {
					if(data == '1')
						alert("操作成功");
					else
						alert("操作失败");
				}
			});
		}
		
		//停止播放
		function stopFilm(id){
			var dir = '2' + currentpath + "/" + document.getElementById(id).innerText;
			$.ajax( {
				type : "post",
				dataType : "text",
				url : './backdeal/ManageFilm.php',
				data : {dir : dir},
				success : function(data) {
					if(data == '3')
						alert("操作成功");
					else
						alert("操作失败");
				}
			});
		}
		
		//获取列表
		function getList(id){
			if(id != "-1"){
				currentpath += "/" + document.getElementById(id).innerText;
			}
			var dir = "0" + currentpath;
			$.ajax( {
				type : "post",
				dataType : "text",
				url : './backdeal/ManageFilm.php',
				data : {dir : dir},
				success : function(data) {
					showDir(data);
				}
			});
		}
		//加载路径
		function showDir(data){
			var strs = data.split("||");
			if(strs[0] == "0")
				alert("播放失败");
			else if(strs[0] == "1")
				alert("播放成功");
			else if (strs[0] == "2"){
				if(strs.length == 1){
					alert("未检测到外设");
					candownload = false;
					return;
				}
				obj.innerText = "当前路径:" + currentpath;
				candownload = true;
				var dirs = strs[1].split(";");
				var files = strs[2].split(";");
				var con = '<thead>';
				var i;
				dircount = 0;
				for(i = 0; i < dirs.length; i++){
					if(dirs[i].length > 0){
						dircount++;
						con += '<tr><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						con += '<span style="color:#CD8500" class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;&nbsp;&nbsp;';
						con += '<a id="' + i + '" onclick="getList(' + i + ')">' + dirs[i] + '</a>';
						con += '</th></tr>';
					}
				}
				for(i = 0; i < files.length; i++){
					var id = i + dircount;
					if(files[i].length > 0){
						con += '<tr><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						con += '<span style="color:#008B8B" class="glyphicon glyphicon-file"></span>&nbsp;&nbsp;&nbsp;&nbsp;';
						con += '<span style="color:#00B2EE" id="' + id + '">' + files[i];
						con += '<button style="float:right;color:#ff0000" onclick="stopFilm(' + id + ')" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-stop"></i></button><button style="float:right;color:#32CD32" onclick="playFilm(' + id + ')" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-play"></i></button></th></tr>';
					}
				}
				con += '</thead>';
				$("#dic_table").empty();
				$("#dic_table").append(con);
			}
		}
		//显示下载界面
		function showDownload(data){
			var str1 = '</span></div><span class="info-box-text">';
			var str2 = '</span><div style="float:left"><span class="info-box-text">';
			var str3 = '-</span></div><div style="float:right"><span class="info-box-text">';
			var str4 = '</span></div><span class="info-box-text">- ';
			var str5 = '</span><div class="progress"><div class="progress-bar" style="width: ';
			var str7 = '</span></div></div>';
			var str = '';
			$("#download_film").empty();
			for(var i = 0; i < data.url.length; i++){
				var id = "'" + 'download' + i + "'";
				var str0 = '<div class="info-box bg-aqua"><span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span><div class="info-box-content"><div style="float:right"><span id=' + id + ' class="progress-description">';
				var str6 = '"></div></div><div class="btn-group-right" style="float:right"><button type="button" onclick="pauseFilm(' + id + ')" class="btn btn-default btn-sm" title="暂停"><i class="glyphicon glyphicon-pause"></i> <button onclick="deleteFilm(' + id + ')" type="button" class="btn btn-default btn-sm" title="删除任务"><i class="glyphicon glyphicon-trash"></i></div><span class="info-box-text"> 剩余时间：';
				var bfb = ((data.downloadsize[i] / data.allsize[i]) * 100).toFixed(2) + "%";
				var arr = data.url[i].split("/");
				var name = arr[arr.length - 1];
				str += str0 + data.url[i] + str1 + name + str2 + data.speed[i] + str3 + bfb + str4 + (data.downloadsize[i]/1024/1024).toFixed(2) + "MB" + '/' + (data.allsize[i]/1024/1024).toFixed(2) + "MB" + str5 + bfb + str6 + data.needtime[i] + str7;
			}
			$("#download_film").append(str);
		}
		//返回上一级
		function back(){
			strs = currentpath.split("/");
			currentpath = strs[0];
			for(var i = 1; i < strs.length - 1; i++){
				currentpath += "/" + strs[i];
			}
			getList("-1");
		}
		
		//获得正在下载数据
		function getDownload(){
			$.ajax( {
				type : "post",
				dataType : "json",
				url : './backdeal/GetDownload.php',
				success : function(data) {
					showDownload(data);
				}
			});
		}
		
		function deleteFilm(id){
			var data = '2' + $('#'+id).text();
			$.ajax( {
				type : "post",
				dataType : "text",
				url : './backdeal/ManageDownload.php',
				data : {data : data},
				success : function(data) {
					alert(data);
				}
			});
		}
		function newFilm(){	
			if(candownload == false){
				alert("未检测到外设，请先连接外设");
				return;
			}
			var data = '1' + $('#url').val();
			$.ajax( {
				type : "post",
				dataType : "text",
				url : './backdeal/ManageDownload.php',
				data : {data : data},
				success : function(data) {
					alert(data);
				}
			});
		}
		function pauseFilm(id){
			var data = '3' + $('#'+id).text();
			$.ajax( {
				type : "post",
				dataType : "text",
				url : './backdeal/ManageDownload.php',
				data : {data : data},
				success : function(data) {
					alert(data);
				}
			});
		}
		window.setInterval(getDownload, 800);//设置定时刷新
	</script>
	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<!--script src="js/ajaxupload.3.6.js"></script-->
</body>
</html>
