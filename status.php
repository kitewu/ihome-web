<?php 
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include_once "./backdeal/CheckSession.php";
	include_once "./backdeal/GetOperationID.php";
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
			<li class="active"><a href="status.php"><span class="glyphicon glyphicon-dashboard"></span> 状态</a></li>
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
				<li class="active">状态</li>
			</ol>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">状态</h1>
			</div>
		</div>
									
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
							<div id="warnning">
							</div>
							<div class="text-muted">通知</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading dark-overlay"><span class="glyphicon glyphicon-time"></span>定时任务</div>
					<div class="panel-body">
						
							<select class="form-control" id="operation">  
								<?php
								for($i = 0; $i < count($timing); $i++){
									echo '<option>';
									echo $timing[$i];
									echo '</option>';  
								}							
								?>
							</select>  

							<select class="form-control" id="frequency">  
							  <option>每天</option>  
							  <option>仅一次</option>  
							</select>  

							<input class="form-control" type="time" id="time"/>

							<button style='float:right' onclick="addTime()" class="btn btn-primary btn-md" id="addTime">添加定时任务</button>

						
					</div>
					<div class="panel-body" id="timingboard">
					</div>					
				</div>

				<div class="panel panel-default chat">
					<div class="panel-heading" id="accordion">
						<font color='20B2AA'><span class="glyphicon glyphicon-envelope glyphicon-m"></span>家庭留言板</font>
					</div>
					<div style="overflow:auto;word-break:break-all"  id="homeboard" class="panel-body"></div>			
					
					<div class="panel-footer">
						<div class="input-group">
							<input id="btn-input" type="text" class="form-control input-md" placeholder="在此输入留言" />
							<span class="input-group-btn">
								<input type="button" class="btn btn-success btn-md" id="btn-chat" value="添加" onclick="addmsgs()"/>
							</span>
						</div>
					</div>
				</div>
			</div>
			
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
					<div class="panel-footer">
						<div class="input-group">
							<input id="btn-inputNote" type="text" class="form-control input-md" placeholder="添加备忘录" />
							<span class="input-group-btn">
								<button onclick="addNote()" class="btn btn-primary btn-md" id="btn-todo">Add</button>
							</span>
						</div>
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
		
		/*刷新函数*/
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
					/*发送火警短信到用户
					var warnvalue = document.getElementById("warnning").value;
					if(data.warnning != "0"){
						sendMsg();
					}*/
					var i;
					/*添加备忘录*/
					$('#note').empty();
					if(data.note != null){
						for(i = 0; i < data.note.length; i++){
							$('#note').append(
								'<li class="todo-list-item"><div class="checkbox"><label id="' + i + '" for="checkbox">' + data.note[i] + '</label></div><div class="pull-right action-buttons"><span onclick="deleteNote(' + i + ')" class="glyphicon glyphicon-trash"></span></div></li>'
							);
						}
					}
					/*添加定时任务*/
					$('#timingboard').empty();
					if(data.t_frequency != null){
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
					}
					/*添加留言*/
					$('#homeboard').empty();
					if(data.from != null){
						for(i = 0; i < data.from.length; i++){
							$('#homeboard').append(
								"<ul><font color='20B2AA' size=5><span class='glyphicon glyphicon-comment'> </span></font><div class='chat-body clearfix'><div class='header'><strong class='primary-font'>" + data.from[i] + "</strong> <small class='text-muted'>" + data.dates[i] + "</small></div><p>" + data.content[i] + "</p></div></ul>"
							);
						}
					}
				}
			});
		} 
		/*删除定时任务*/
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
		
		/*添加定时任务*/
		function addTime(){
			var operation = document.getElementById('operation').value;
			var frequency = document.getElementById('frequency').value;
			var time = document.getElementById('time').value;
			var temp_time = time.split(":");
			var hour = temp_time[0];
			var minute = temp_time[1];
			if(parseInt(hour) != hour || hour > 23 || hour < 0){
				alert("小时不正确");
				return;
			}
			if(parseInt(minute) != minute || minute > 59 || minute < 0){
				alert("分钟不正确");
				return;
			}
			if(frequency == "仅一次"){
				var myDate = new Date();
				if(hour < myDate.getHours()){
					alert("当前设定时间小于系统时间，定时任务将被删除!");
					return;
				}else if(hour == myDate.getHours()){
					if(minute <= myDate.getMinutes()){
						alert("当前设定时间小于系统时间，定时任务将被删除!");
						return;
					}
				}
			}
			$.ajax( {
				type : "post",
				url : './backdeal/SetTiming.php',   
				data : {operation : operation, frequency : frequency, hour : hour, minute : minute},
				success : function(data) {
					$("#hour").val("小时");
					$("#minute").val("分钟");
					alert(data);
				}
			});
		}
		/*出现火警发送短信通知*/
		function sendMsg(){
			$.ajax( {
				type : "post",
				url : './backdeal/GetPhoneNum.php',       
				success : function(data) {       
					Bmob.initialize("cff952e1d0649f3eb68ad0bed6bade07", "d0a07fa6562d6a199cbc422f1a55c31c");
					Bmob.Sms.requestSmsCode({"mobilePhoneNumber": data} ).then(function(obj) {
					  alert("发送成功");
					}, function(err){
					  alert("发送失败:"+err);
					});
				}
			});
		}
		/*添加留言*/
		function addmsgs(){
			var content = document.getElementById('btn-input').value;
			document.getElementById('btn-input').value = "";
			if(content != "" && content != null){
				$.ajax( {
					type : "post",
					data:{Content: content},
					url : './backdeal/AddMsg.php',       
					success : function(data) {       
						alert(data);
					}
				});
			}
		}
		/*添加一条备忘录*/
		function addNote(){
			var note = document.getElementById('btn-inputNote').value;
			document.getElementById('btn-inputNote').value = "";
			if(note != "" && note != null){
				$.ajax( {
					type : "post",
					data:{Note: note},
					url : './backdeal/AddNote.php',       
					success : function(data) {       
						alert(data);
					}
				});
			}
		}
		/*删除一条备忘录*/
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
		window.setInterval(flush, 1500); 
		/*日历*/
		$('#calendar').datepicker({
		});
		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>
</html>
