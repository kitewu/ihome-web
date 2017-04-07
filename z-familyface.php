<?php 
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include "./backdeal/CheckSession.php";
	include "./backdeal/GetPerson.php";
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
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
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
										echo '<input type="file" style="width:100px" id="'.$row['name'].'" name="'.$row['name'].'"></input>';
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
						
					</div>
				</div>
			</div>

	</div>	<!--/.main-->
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
		function deletePerson(id){
			$.ajax( {
				type : "post",
				url : './backdeal/ManageFace.php',
				data : {Name : id, Type : 'deleteP'},
				success : function(data) {
					if(data == 'success'){
						location.reload();
					}
					alert(data);
				}
			});
		}
	</script>
	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="js/ajaxupload.3.6.js"></script>
</body>

</html>
