<?php 
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include "./backdeal/CheckSession.php";
	include "./backdeal/GetOperationID.php";
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
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading dark-overlay"><span class="glyphicon glyphicon-time"></span>定时任务</div>
					<div class="panel-body" id="timingboard">
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
					$('#timingboard').empty();
					var str1 = '<table class="table table-striped table-bordered bootstrap-datatable datatable"><thead><tr><th>操作</th><th>时间</th><th>频率</th><th>删除</th></tr></thead><tbody>';
					for(var i = 0; i < data.t_frequency.length; i++){
						str1 += '<tr>';
						str1 += '<td id="a' + i +'">' + data.t_operation[i] + '</td>';
						str1 += '<td id="b' + i +'">' + data.t_time[i] + '</td>';
						str1 += '<td id="c' + i +'">' + data.t_frequency[i] + '</td>';
						str1 += '<td id="d' + i +'">' + '<span onclick="deleteTiming(' + i + ')" class="glyphicon glyphicon-trash"></span>' + '</td>';
						str1 += "</tr>";
					}
					str1 += '</tbody></table>';
					$('#timingboard').append(str1);
					i = i;
				}
			});
		} 
		//删除定时任务
		function deleteTiming(i){
			var op = document.getElementById("a"+i).innerText;
			var time = document.getElementById("b"+i).innerText;
			var fre = document.getElementById("c"+i).innerText;
			$.ajax( {
				type : "post",
				url : './backdeal/DeleteTiming.php',   
				data : {operation : op, frequency : fre, time : time},
				success : function(data) {
					alert(data);
				}
			});
		}
		window.setInterval(flush, 1000); 
	</script>	
</body>

</html>
