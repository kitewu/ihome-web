<?php 
	error_reporting(E_ALL || ~E_NOTICE);
	session_start();
	include_once "CheckThisPathSession.php"; 
?>
<html>
	<center>
		<img height="350px" id="img" width="340px" src="http://192.168.0.80:8080/?action=stream" />
	</center>
</html> 
<script>
	window.onload = function(){
		createImageLayer();
	};
	
	function createImageLayer() {
		var img = new Image();
		img.src = "http://192.168.0.80:8080/?action=stream";
		img.onerror=function(){
			var imgs = document.getElementById("img");
			imgs.src = "http://192.168.0.80:8080/?action=stream";
		};
	}
</script>