<?php
/*
 *获得历史数据记录，温度，湿度，亮度
 */
include_once "ConnectDatabase.php";

$mydate = $_GET['mydate'];
$flag = $_GET['flag'];
$homeid = $_GET['homeid'];

$link = connect($homeid);

$query = "select times, {$flag} from t_record where dates = '{$mydate}'";
$result = mysql_query($query);

$count_num = mysql_num_rows($result);    //数据条数
$max_inter = 8;
if ($count_num > $max_inter)
    $step = ceil($count_num / $max_inter);
else
    $step = 1;
$inter = 0;

while ($row = mysql_fetch_row($result)) {
    if ($inter == $step) {
        $x[] = $row[0];
        $y[] = $row[1];
        $inter = 0;
    }
    $inter++;
}

echo json_encode(array("x"=>$x, "y"=>$y));