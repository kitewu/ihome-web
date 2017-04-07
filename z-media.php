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
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
</head>
<body>		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">		
		<div class="row">			
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<font size="5px"></font>
						<button style='float:left' onclick="functionOpen()" class="btn btn-primary">打开投影仪</button>
						<button style='float:right' onclick="functionClose()" class="btn btn-primary">关闭投影仪</button>
					</div>	
				</div>
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
	</div>
	<script>
		var currentpath = "usb";
		var dircount = 0;
		var obj = document.getElementById("head");
		window.onload = function(){
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
					alert(data);
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
					alert(data);
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
		//返回上一级
		function back(){
			strs = currentpath.split("/");
			currentpath = strs[0];
			for(var i = 1; i < strs.length - 1; i++){
				currentpath += "/" + strs[i];
			}
			getList("-1");
		}
		
		function functionOpen(){
			$.post("./backdeal/SetState.php", {deviceID: "0002", deviceState: true},
				function(data) {
				//	alert(data);
				});
		}
		
		function functionClose(){
			$.post("./backdeal/SetState.php", {deviceID: "0002", deviceState: false},
				function(data) {
				//	alert(data);
				});
		}
	</script>
	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</body>
</html>
