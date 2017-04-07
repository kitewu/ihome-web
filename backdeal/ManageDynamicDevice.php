<?php
/**
 * 管理动态添加节点
 */
error_reporting(E_ALL || ~E_NOTICE);
session_start();
include_ONCE "CheckThisPathSession.php";
include_ONCE "ConnectDatabase.php";
include_ONCE "Socket.php";
connect($_SESSION['homeid']);

class ManageNode
{
//    private $head_tail = array();
    //id  设备名
//    private $id_device = array(
//        "0001"=>"ketingdeng",
//        "0002"=>"ketingkongtiao",
//        "0003"=>"woshifengshan",
//        "0004"=>"woshitiaoguangdeng",
//        "0008"=>"woshichuanglian",
//        "0005"=>"xishoujiandeng",
//        "0006"=>"chufangdeng"
//    );
    private $head_tail = array(
        "tail" => "../code/tail.code",
        "head" => "../code/head.code",
        "sub_tail_keting" => "../code/sub_tail_keting.code",
        "sub_tail_woshi" => "../code/sub_tail_woshi.code",
        "sub_tail_chufang" => "../code/sub_tail_chufang.code",
        "sub_tail_xishoujian" => "../code/sub_tail_xishoujian.code",
        "sub_head_keting" => "../code/sub_head_keting.code",
        "sub_head_woshi" => "../code/sub_head_woshi.code",
        "sub_head_chufang" => "../code/sub_head_chufang.code",
        "sub_head_xishoujian" => "../code/sub_head_xishoujian.code");


    //设备名 地址
    private $deviceid_url = array(
        "0001" => "../code/ketingdeng.code",
        "0002" => "../code/ketingkongtiao.code",
        "0003" => "../code/woshifengshan.code",
        "0004" => "../code/woshitiaoguangdeng.code",
        "0008" => "../code/woshichuanglian.code",
        "0005" => "../code/xishoujiandeng.code",
        "0006" => "../code/chufangdeng.code"
    );

    /**
     * 从数据库获得设备
     */
    public function getDevice()
    {
        mysql_select_db($_SESSION['homeid']);
        $sql = "select id from t_device_stat where flag = 1";
        $result = mysql_query($sql);
        while ($row = mysql_fetch_row($result)) {
            $this->c_device[] = $row[0];
        }
    }


}

?>