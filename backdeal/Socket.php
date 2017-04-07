<?php
error_reporting(E_ALL || ~E_NOTICE);
include_once "Config.php";
function SendMsg($msg)
{
    global $SERVER_IP;
    global  $PORT;
    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die ('could not create socket');
    socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array("sec" => 2, "usec" => 0));
    socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array("sec" => 2, "usec" => 0));
    $connect = socket_connect($socket, $SERVER_IP, $PORT);
    socket_write($socket, $msg);
    socket_close($socket);
    return "1";
}

function SendAndRecMsg($msg)
{
    global $SERVER_IP;
    global  $PORT;
    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die ('could not create socket');
    socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array("sec" => 2, "usec" => 0));
    socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array("sec" => 2, "usec" => 0));
    $connect = socket_connect($socket, $SERVER_IP, $PORT);
    socket_write($socket, $msg);
    $getmsg = socket_read($socket, 1024);
    socket_close($socket);
    return $getmsg;
}
	
	
   
