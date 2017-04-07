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
			<div class="col-md-4">
				<div class="panel panel-red">
					<div class="panel-heading dark-overlay"><span class="glyphicon glyphicon-calendar"></span>日历</div>
					<div class="panel-body">
						<div id="calendar"></div>
					</div>
				</div>
				
				<div class="panel panel-blue">
					<div class="panel-heading dark-overlay"><span class="glyphicon glyphicon-check"></span>备忘录</div>
					<div class="panel-body">
						<ul id="note" class="todo-list">
						</ul>
					</div>
				</div>
			</div>
		</div>	
	</div> 
	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
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
					//添加备忘录
					$('#note').empty();
					for(i = 0; i < data.note.length; i++){
						$('#note').append(
							'<li class="todo-list-item"><div class="checkbox"><label id="' + i + '" for="checkbox">' + data.note[i] + '</label></div><div class="pull-right action-buttons"><span onclick="deleteNote(' + i + ')" class="glyphicon glyphicon-trash"></span></div></li>'
						);
					}
					i = i;
				}
			});
		} 
		
		//删除一条备忘录
		function deleteNote(checkboxid){
			var value=$("#" + checkboxid).text();
			$.ajax( {
					type : "post",
					data:{Content: value},
					url : './backdeal/DeleteNote.php',       
					success : function(data) {       
						alert(data);
					}
			});
		}
		
		window.setInterval(flush, 1000); 
		
		$('#calendar').datepicker({
		});

	</script>	
</body>

</html>
