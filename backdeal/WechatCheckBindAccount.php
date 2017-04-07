<?php
include_once "ConnectDatabase.php";
connect("ihome_global");

$email = $_POST["email"];
$passwd = $_POST["passwd"];
$passwd = md5($passwd);
$wechatid = $_POST["wechatid"];

$select_sql = "SELECT * FROM t_user WHERE email = '{$email}' and password = '{$passwd}'";
$query = mysql_query($select_sql);
$result = mysql_fetch_array($query, MYSQL_ASSOC);
if ($result['email'] != "") {
    $sql = "update t_user set wchatid = '{$wechatid}' where email = '{$email}'";
    $rresult = mysql_query($sql);
    if($rresult)
        echo "操作成功";
    else
        echo "操作失败,请检查用户名和密码是否正确";
} else {
    echo "操作失败,请检查用户名和密码是否正确";
}
?>