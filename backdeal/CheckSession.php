<?php
	session_start();
		
    if(!$_SESSION['isLogin']){
        header("Location:./index.php");
        exit();
	}
