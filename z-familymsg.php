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
	<div style="overflow:auto;word-break:break-all" id="homeboard" class="panel-body"></div>
	</div>				
	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script>
		var a = 0;
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
					//添加留言
					$('#homeboard').empty();
					var i;
					for(i = data.from.length - 1; i>=0; i--){
						$('#homeboard').append(
							"<ul><font color='20B2AA' size=5><span class='glyphicon glyphicon-comment'> </span></font><div class='chat-body clearfix'><div class='header'><strong class='primary-font'>" + data.from[i] + "</strong> <small class='text-muted'>" + data.dates[i] + "</small></div><p>" + data.content[i] + "</p></div></ul>"
						);
					}
					$('#homeboard').append('<label id="bottom"></label>');
					if(data.from.length != window.a){
						window.a = data.from.length;
						window.location.href="z-familymsg.php#bottom";
					}
						
				}
			});
		} 
		window.setInterval(flush, 1000);
	</script>	
</body>

</html>
