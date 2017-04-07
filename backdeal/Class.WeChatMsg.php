<?php
include_once "Class.WeChatTextMsg.php";
include_once "Class.WeChatVoiceMsg.php";
include_once "Class.WeChatEventMsg.php";
include_once "ConnectDatabase.php";
include_once "Config.php";
/**
 * 消息父类
 * Class Msg
 */
abstract class Msg
{
    protected $homeid = null;

    protected $postObj = null;

    protected $control = "回复指令进行相关操作\n10-->客厅灯关\n11-->客厅灯开\n20-->客厅空调关\n21-->客厅空调开\n30-->卧室风扇关\n31-->卧室风扇开\n40-->卧室调光灯关\n41-->卧室调光灯开\n50-->洗手间灯关\n51-->洗手间灯开\n60-->厨房灯关\n61-->厨房灯开\n70-->关闭卧室窗帘\n71-->打开卧室窗帘\n80-->关闭离家模式\n81-->开启离家模式\n82-->关闭智能模式\n83-->开启智能模式\n84-->关闭智能窗帘\n85-->开启智能窗帘";

    /**
     * 构造函数
     * Msg constructor.
     */
    function __construct($postObj)
    {
        $this->postObj = $postObj;
    }

    /**
     * 连接数据库
     */
    public function connectDatabase()
    {

        global $DB_ADDRESS;
        global $DB_USERNAME;
        global $DB_PASSWD;
        connect($DB_ADDRESS, $DB_USERNAME, $DB_PASSWD);
     //   $this->conn = mysql_connect($DB_ADDRESS, $DB_USERNAME, $DB_PASSWD);
     //   mysql_query('set names utf8');
    }

    /**
     * 处理消息入口的抽象函数
     * @return mixed
     */
    abstract public function handleMsg();

    /**
     * 获得回复消息文本格式
     * @param $object
     * @param $content
     * @param int $flag
     * @return string
     */
    public function getResponseText($object, $content, $flag = 0)
    {
        $textTpl = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[text]]></MsgType>
            <Content><![CDATA[%s]]></Content>
            <FuncFlag>%d</FuncFlag>
        </xml>";
        $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content, $flag);
        return $resultStr;
    }

    /**
     * 检查用户微信是否与homeid是否绑定
     * @param $fromUsername
     * @return bool
     */
    public function checkHave($fromUsername)
    {
        mysql_select_db("ihome_global");
        $query = "select homeid from t_user where wchatid = '{$fromUsername}'";
        $result = mysql_query($query);
        $row = mysql_fetch_row($result);
        if ($row[0] != null) {
            $this->homeid = $row[0];
            return true;
        }
        return false;
    }
}

?>