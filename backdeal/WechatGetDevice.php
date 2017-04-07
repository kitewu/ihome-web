<?php
/**
 * 微信获得历史记录设备信息
 */
include_once "ConnectDatabase.php";

$homeid = $_GET['homeid'];
connect($homeid);

$result = mysql_query("select device from t_device_stat where flag = 1");
while ($row = mysql_fetch_row($result)) {
    $devicename[] = $row[0];
}
?>