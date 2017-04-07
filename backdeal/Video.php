<html>
	<center>
		<img height="800px" id="img" width="960px" src="http://192.168.0.81:8080/?action=stream" />
	</center>
</html>
<script>
	window.onload = function(){
		createImageLayer();
	};
	function createImageLayer() {
		var img = new Image();
		img.src = "http://192.168.0.81:8080/?action=stream";
		img.onerror=function(){
			var img = document.getElementById("img");
			img.src = "http://115.159.23.237/proxy/?action=stream";
		};
	}
</script>