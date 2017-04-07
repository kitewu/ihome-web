<?php
error_reporting(E_ALL || ~E_NOTICE);
session_start();
include_once "CheckThisPathSession.php";
include_once "Config.php";
$msg = $_POST['dir'];
$msg = str_replace("/", ";", $msg);
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die ('could not create socket');
socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array("sec" => 2, "usec" => 0));
socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array("sec" => 2, "usec" => 0));
$connect = socket_connect($socket, $SERVER_IP, $PORT);
socket_write($socket, "1/10/" . $_SESSION['homeid'] . "/" . $msg);
$getmsg = socket_read($socket, 4096);
echo $getmsg;
socket_close($socket);