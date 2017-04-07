<?php
include_once "AI.php";
include_once "Socket.php";

/**
 * 处理文本消息
 * Class TextMsg
 */
class TextMsg extends Msg
{
    /**
     * 构造函数
     * Msg constructor.
     */
    function __construct($obj)
    {
        parent::__construct($obj);
    }

    /**
     * 处理文本消息
     */
    public function handleMsg()
    {
        $resultStr = "Input something...";
        $keyword = trim($this->postObj->Content);
        if (!empty($keyword)) {
            $this->connectDatabase();
            $resultStr = $this->getContentStr($keyword, $this->postObj->FromUserName);
        }
        return $this->getResponseText($this->postObj, $resultStr);
    }

    /**
     * 获得回复文本消息的内容
     * @param $keyword
     * @param $fromUsername
     * @return string
     */
    public function getContentStr($keyword, $fromUsername)
    {
        if ($this->checkHave($fromUsername)) {
            $msgid = $this->judgeMsg($keyword);//判断消息类型是否是指令
            if ($msgid == "") {//不是指令调用服务器处理
                $contentStr = SendAndRecMsg("1/13/" . $this->homeid . "/" . $keyword);//服务器处理结果
                if ($contentStr == "指令未识别") {//不是语音指令则调用AI机器人回复
                    $contentStr = getAIResult($keyword);
                }
            } else {//是指令处理指令
                $contentStr = $this->handleOther($msgid);
            }
        } else {
            $contentStr = "用户未绑定，请先绑定账户，点击 工具->帮助 查看帮助信息";
        }
        return $contentStr;
    }

    /**
     * 处理消息，发送控制命令，更新状态表，插入操作数据
     * @param $msgid
     * @return string
     */
    public function handleOther($msgid)
    {
        $rejson = json_decode($this->GetMsgId(), true);
        $operation_msg_id = $rejson['operation_msg_id'];
        $operation_type_id = $rejson['operation_type_id'];
        $operation_content = $rejson['operation_content'];

        $msg = $operation_msg_id[$msgid];
        SendMsg("1/1/" . $this->homeid . "/" . $msg);

        mysql_select_db($this->homeid);

        if ($msgid == "0001" || $msgid == "0002" || $msgid == "0003" || $msgid == "0004" || $msgid == "0005" || $msgid == "0006" || $msgid == "0008" || $msgid == "0009" || $msgid == "0010" || $msgid == "0011") {
            $stat = 0;
        } else {
            $stat = 1;
        }
        $query = "update t_device_stat set stat = '{$stat}' where id = '{$operation_type_id[$msgid]}'";
        mysql_query($query);

        $date = date("Y-m-d", time());
        $time = date("H:i:s", time());
        $query = "insert into t_operation (dates, times, types, operation) values('{$date}', '{$time}', '{$operation_type_id[$msgid]}' , '{$operation_content[$msgid]}')";
        mysql_query($query);

        $result = $operation_content[$msgid] . " 操作成功";
        return $result;
    }

    /**
     * 获得MsgId
     * @return string
     */
    public function GetMsgId()
    {
        mysql_select_db($this->homeid);
        $query = "select * from t_operation_id";
        $result = mysql_query($query);
        while ($row = mysql_fetch_assoc($result)) {
            $operation_msg_id[$row['id']] = $row['msg_id'];
            $operation_type_id[$row['id']] = $row['types'];
            $operation_content[$row['id']] = $row['operation'];
        }
        return json_encode(array('operation_msg_id' => $operation_msg_id,
            'operation_type_id' => $operation_type_id,
            'operation_content' => $operation_content));
    }

    /**
     * 判断消息类型，返回消息id
     * @param $msgs
     * @return string
     */
    public function judgeMsg($msgs)
    {
        switch ($msgs) {
            case "10" :
                $msg = "0001";//客厅灯
                break;
            case "11" :
                $msg = "000101";
                break;
            case "20" :
                $msg = "0002";//客厅空调
                break;
            case "21" :
                $msg = "000201";
                break;
            case "30" :
                $msg = "0003";//卧室风扇
                break;
            case "31" :
                $msg = "000301";
                break;
            case "40" :
                $msg = "0004";//卧室调光灯
                break;
            case "41" :
                $msg = "000401";
                break;
            case "50" :
                $msg = "0005";//洗手间灯
                break;
            case "51" :
                $msg = "000501";
                break;
            case "60" :
                $msg = "0006";//厨房灯
                break;
            case "61" :
                $msg = "000601";
                break;
            case "70" :
                $msg = "0008";//卧室窗帘
                break;
            case "71" :
                $msg = "000801";
                break;
            case "80" ://关闭离家模式
                $msg = "0011";
                break;
            case "81" ://开启离家模式
                $msg = "001101";
                break;
            case "82" ://关闭智能模式
                $msg = "0010";
                break;
            case "83" ://开启智能模式
                $msg = "001001";
                break;
            case "84" ://关闭智能窗帘
                $msg = "0009";
                break;
            case "85" ://开启智能窗帘
                $msg = "000901";
                break;
            default :
                $msg = "";
                break;
        }
        return $msg;
    }
}

?>