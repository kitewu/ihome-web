<?php
	function getAIResult($content){
		$ch = curl_init();
		$url = 'http://apis.baidu.com/turing/turing/turing?key=f88d75ec75a045da827d0b34f8abbe5b&info='.$content.'&userid=eb2edb736';//turing的
		$header = array(
			'apikey: 92e10d91b8c56e3698f2b2efb6f2a4c0',//百度的
		);
		curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch , CURLOPT_URL , $url);
		$res = curl_exec($ch);
		$array = json_decode($res, true);
		return $array["text"];
	}
?>