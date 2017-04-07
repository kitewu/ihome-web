<?php
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include_once "CheckThisPathSession.php"; 
	include_once "ConnectDatabase.php";
	include_once "Face.class.php";
	connect($_SESSION['homeid']);
	
	$api_key = 'b68340946ae8e52bd5ae95442b994405';
	$api_secret = 'znG4oojNL1l-Ic3GV5_F_FuTQQC6KCiw';
	$api = new FacePPClient($api_key, $api_secret);
	if($_POST['Type'] == 'deleteP'){//删除成员
		$result = $api->person_delete($_SESSION['homeid']."/".$_POST['Name']);
		if(!empty($result['error'])){
			echo "删除失败，请重试";return;
		}
		$result = $api->train_identify("ihome");	
		if(!empty($result['error'])){
			echo "删除失败，请重试";return;
		}
		$sql = "delete from t_person where name = '{$_POST['Name']}'";
		$result = mysql_query($sql);	
		if($result){
			echo "删除成功";
		}else{
			echo "删除失败，请重试 ";
		}
	}
	if($_POST['Type'] == 'addP'){//添加成员
		$sql = "select name from t_person where name = '{$_POST['Name']}'";
		$result = mysql_query($sql);
		$row = mysql_fetch_assoc($result);
		if($row['name'] == null){
			$result = $api->person_create($_SESSION['homeid']."/".$_POST['Name']);
			if(!empty($result['error'])){
				echo "添加失败，请重试";return;
			}
			$result = $api->group_add_person($_SESSION['homeid']."/".$_POST['Name'], "ihome");
			if(!empty($result['error'])){
				echo "添加失败，请重试";return;
			}
			$result = $api->train_identify("ihome");
			if(!empty($result['error'])){
				echo "添加失败，请重试";return;
			}
			$sql = "insert into t_person values('{$_POST['Name']}','0')";
			$result = mysql_query($sql);
			if($result){
				echo "添加成功";return;
			}
			else{
				echo "添加失败，请重试";return;
			}
		}else{
			echo '成员已存在';
		}
	}