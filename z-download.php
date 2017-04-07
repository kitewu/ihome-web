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
					<div class="panel-body">
						<p id="url"></p>
					</div>
					<div id="download_film" class="panel-body">
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		window.onload = function(){
			getDownload();
		};
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
		function pauseFilm(id){
			var data = '3' + $('#'+id).text();
			$.ajax( {
				type : "post",
				dataType : "text",
				url : './backdeal/ManageDownload.php',
				data : {data : data},
				success : function(data) {
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
				}
			}); 
		}
		window.setInterval(getDownload, 800);//设置定时刷新
	</script>
	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</body>
</html>
