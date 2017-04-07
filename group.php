<?php 
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include_once "./backdeal/CheckSession.php";
	include_once "./backdeal/GetGroupMember.php";
	require_once 'cs.php';
	echo '<img src="'._cnzzTrackPageView(1260107436).'" width="0" height="0"/>';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>iHome</title>
<style>
	.table th, .table td { 
		text-align: center; 
		height:38px;
	}
</style>
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
			<li><a href="media.php"><span class="glyphicon glyphicon-film"></span> 家庭影院</a></li>
			<li><a href="access.php"><span class="glyphicon glyphicon-user"></span> 权限管理</a></li>
			<li><a href="devicemanage.php"><span class="glyphicon glyphicon-plus-sign"></span> 设备管理</a></li>
			<li class="active"><a href="group.php"><span class="glyphicon glyphicon-user"></span> 家庭成员管理</a></li>
			<li role="presentation" class="divider"></li>
			<li><a href="logout.php"><span class="glyphicon glyphicon-remove-sign"></span> 退出登录</a></li>
		</ul>
	</div>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">家庭成员管理</li>
			</ol>
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">家庭成员管理</h1>
			</div>
		</div>
		<div class="row">			
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading ">
						<font size="5px"><?php echo $_SESSION['homeid'];?></font>
						<button style="float:right" class="btn btn-primary btn-md" onclick="addMember()">添加成员</button>
					</div>	
					<div class="panel-body">
						<table class="table table-striped table-bordered bootstrap-datatable datatable"> 
							<thead>
								<tr><th>名称</th><th>邮箱</th><th>注册时间</th><th>手机号</th><th>删除成员</th></tr>
							</thead>
							<tbody>
							 <?php
								for($i = 0; $i < count($user); $i++){
									$row = $user[$i];
									echo '<tr>';
									echo '<td>'.$row['name'].'</td>';
									
									echo '<td>';
									for($j = 1; $j <= strlen($row['email']); $j++){
										echo $row['email'][$j - 1];
										if($j % 9 == 0){
											echo "<br>";
										}
									}
									echo '</td>';
									
									echo '<td>';
									$str1 = substr($row['registertime'], 0, 4);
									$str2 = substr($row['registertime'], 4, 6);
									echo $str1."<br>".$str2;
									echo '</td>';
									
									echo '<td>';
									if($row['phonenumber'] != null){
										$str1 = substr($row['phonenumber'], 0, 6);
										$str2 = substr($row['phonenumber'], 6, 5);
										echo $str1."<br>".$str2;
									}
									echo '</td>';
									
									echo '<td>';
									echo '<button class="btn btn-danger" onclick=deleteMember("'.$row['email'].'")><i class="glyphicon glyphicon-trash"></i> </button>';
									echo '</td>';
									echo '</tr>';
								}
							?>			  
							</tbody>
						</table>        
					</div>
					<div class="panel-footer" id="id_check_passwd">
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script>
		var EMAIL = null;
		/*添加成员*/
		function addMember(){
			window.location.href='create-account.php';
		}
		/*删除成员*/
		function deleteMember(email){
			EMAIL = email;
			$('#id_check_passwd').empty();
			$('#id_check_passwd').append('<div class="input-group"><input id="input_password" type="password" class="form-control input-md" placeholder="输入homeid密码以完成验证"><span class="input-group-btn"><button class="btn btn-primary btn-md" onclick="checkPassword()"> 确定 </button></span></div>');
		}
		/*验证密码*/
		function checkPassword(){
			var password = $("#input_password").val();
			if(password == ""){
				alert("密码不能为空");
				return;
			}
			$.ajax( {
				type : "post",
				url : './backdeal/ManageGroup.php',
				data : {Email : EMAIL, Password : password},
				success : function(data) {
					if(data == '删除成功'){
						location.reload();
					}
					alert(data);
				}
			});
		}
	</script>
</body>
</html>
