<?php
/**
 * 微信获得历史记录图表数据
 */

include_once "ConnectDatabase.php";

$devicename = $_GET["devicename"];
$homeid = $_GET["homeid"];
$startdate = $_GET['startdate'];
$lastdate = $_GET['lastdate'];

connect($homeid);

$result = mysql_query("select * from t_device_stat where flag = 1");
while($row = mysql_fetch_assoc( $result)){
    $devicename_and_id[$row['device']] = $row['id'];
}

$query="select * from t_operation";
if( $devicename != "全部操作记录"){
    $query = $query." where types = '{$devicename_and_id[$devicename]}'";
}
else{
    $query = $query." where dates is not null ";
}
if($startdate != null or $lastdate != null){
    if($startdate == null){
        $startdate = '1970-01-01';
    }
    if($lastdate == null){
        $lastdate = date("Y-m-d", time());
    }
    $query = $query." and dates >=  '{$startdate}' and dates <=  '{$lastdate}'";
}
$result = mysql_query($query);
$arrs = array();
while($row = mysql_fetch_assoc($result)){
    $arrs[] = array("id"=>$row['homeid'], "date"=>$row['dates'], "time"=>$row['times'], "operation"=>$row['operation']);
}
echo json_encode($arrs);
?>