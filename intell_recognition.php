<?php 
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include_once "./backdeal/CheckSession.php";
	include_once "./backdeal/GetPerson.php";
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
			<li class="active"><a href="intell_recognition.php"><span class="glyphicon glyphicon-eye-open"></span> 智能识别</a></li>
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
				<li class="active">智能识别</li>
			</ol>
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">智能识别</h1>
			</div>
		</div>
		<div class="row">			
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading ">
						<font size="5px">成员管理</font>
					</div>	
					<div class="panel-body">
						<table class="table table-striped table-bordered bootstrap-datatable datatable"> 
							<thead>
								<tr><th>成员</th><th>照片数量</th><th>选择照片</th><th>上传</th><th>删除成员</th></tr>
							</thead>
							 <tbody>
							 <?php
								for($i = 0; $i < count($person); $i++){
									$row = $person[$i];
									echo '<tr>';
									echo '<td>'.$row['name'].'</td>';
									
									echo '<td>';
									echo $row['pics_count'].'张照片';
									echo '</td>';
									
									echo '<td>';
									echo '<div class="btn btn-default btn-file"> <i class="glyphicon glyphicon-folder-open"></i> 选择文件 <input type="file" id="'.$row['name'].'" name="'.$row['name'].'"></input></div>';
									echo '</td>';
									
									echo '<td>';
									echo '<button class="btn btn-success" onclick=addFace("'.$row['name'].'")><i class="glyphicon glyphicon-cloud-upload"></i></button>';
									echo '</td>';
									
									echo '<td>';
									echo '<button class="btn btn-danger" onclick=deletePerson("'.$row['name'].'")><i class="glyphicon glyphicon-trash"></i> </button>';
									echo '</td>';
									echo '</tr>';		
								}
							 ?>			  
							</tbody>
						</table>        
					</div>
					<div class="panel-footer">
						<div class="input-group">
							<input id="input_name" type="text" class="form-control input-md" placeholder="输入成员姓名"></input>
							<span class="input-group-btn">
								<button class="btn btn-primary btn-md" onclick="addPerson()">添加成员</button>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	<!--/.main-->
	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="js/ajaxupload.3.6.js"></script>
	<script>
		function addFace(name){
			$.ajaxFileUpload({
				url:'./backdeal/DealUploadFile.php',
				secureuri :false,
				fileElementId : name,
				data:{name:name},
				dataType : 'text',
				success : function (data){
					alert(data);
					location.reload();
				}
			});
		}
		
		function addPerson(){
			var name = $("#input_name").val();
			$("#input_name").val("");
			if(name == "" || name == null){
				alert("姓名不能为空");
				return;
			}
			if(name.length > 10){
				alert("姓名过长，请限制在10个字符以内");
				return;
			}
			$.ajax( {
				type : "post",
				url : './backdeal/ManageFace.php',
				data : {Name : name, Type : 'addP'},
				success : function(data) {
					if(data == '添加成功'){
						location.reload();
					}
					alert(data);
				}
			});
		}
		function deletePerson(id){
			$.ajax( {
				type : "post",
				url : './backdeal/ManageFace.php',
				data : {Name : id, Type : 'deleteP'},
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
