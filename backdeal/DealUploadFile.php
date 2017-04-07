<?php
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include_ONCE "CheckThisPathSession.php"; 
	include_ONCE "ConnectDatabase.php";
	include_ONCE "Face.class.php";
	
	$api_key = 'b68340946ae8e52bd5ae95442b994405';
	$api_secret = 'znG4oojNL1l-Ic3GV5_F_FuTQQC6KCiw';
	$max_size = 1048576;
	$name = $_REQUEST['name'];
	$file = $_FILES[$name];
	
	if(!checkType($file['name'])){
		echo "图片格式不正确";
		return;
	}
	if($file['size'] > $max_size){
		echo "图片过大，请限制在1M以内";
		return;
	}
	
	if(move_uploaded_file($file['tmp_name'], "../pics/".$name.".jpg")){
		$api = new FacePPClient($api_key, $api_secret);
		$result = $api->face_detect_post("../pics/".$name.".jpg");  //识别图片
		$face_id = $result['face'][0]['face_id'];   //返回id
		if(!empty($result['error'])){
			echo "添加人脸失败，请重新尝试";return;
		}
		unlink("../pics/".$name.".jpg");  //删除本地图片
		$result = $api->person_add_face($face_id, $_SESSION['homeid']."/".$name);  //person add face
		if(!empty($result['error'])){
			echo "未识别人脸，请更换照片";return;
		}
		$result = $api->train_identify("ihome");	
		if(!empty($result['error'])){
			echo "训练模型失败，请重新尝试";return;
		}
		connect($_SESSION['homeid']);
		$sql = "update t_person set pics_count = pics_count+1 where name = '{$name}'";  //更新数据库
		$result = mysql_query($sql);
		if(!$result){
			echo "数据库出错";return;
		}
		echo "添加成功";
	}else{
		echo "图片上传失败";
	}
		
	function checkType($file){
		$temp = pathinfo($file);
		if(in_array(strtolower($temp['extension']),array('jpg','jpeg','png')))
			return true;
		return false;
	}
?>