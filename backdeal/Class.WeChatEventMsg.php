<?php
/**
 * 处理事件消息
 * Class EventMsg
 */
class EventMsg extends Msg
{
    private $picurlthl = "http://wslzjy.cn/ihome/pics/wechatchart.png";//温度湿度亮度图文消息图片url
    private $picurlbind = "http://wslzjy.cn/ihome/pics/wechatbindaccount.png";//绑定账号图文消息图片url
    private $picurloperation = "http://wslzjy.cn/ihome/pics/wechatoperationhistory.png";//操作记录图文消息图片url

    private $bindaccounturl = "http://wslzjy.cn/ihome/backdeal/WechatBindAccount.php";//绑定账号url
    private $charturl = "http://wslzjy.cn/ihome/backdeal/WechatChart.php";//图表url
    private $operationhistoryurl = "http://wslzjy.cn/ihome/backdeal/WechatHistory.php";//历史记录url

    /**
     * 构造函数
     * Msg constructor.
     */
    function __construct($obj)
    {
        parent::__construct($obj);
    }

    /**
     * 处理语音消息
     * @return mixed
     */
    public function handleMsg()
    {
        switch ($this->postObj->Event) {
            case "subscribe"://用户关注
                $result = $this->getResponseText($this->postObj, "欢迎关注智能家居服务平台,点击 工具->帮助 或回复帮助查看帮助信息。");
                break;
            case "CLICK"://自定义菜单点击事件
                if ($this->postObj->EventKey == "tool_help") {//帮助菜单
                    $result = $this->getResponseText($this->postObj, $this->control);
                } else if ($this->postObj->EventKey == "tool_binding_account") {
                    $result = $this->getResponseTextPic("绑定账号", $this->picurlbind, $this->bindaccounturl . "?id=" . $this->postObj->FromUserName);
                } else {
                    $this->connectDatabase();
                    if ($this->checkHave($this->postObj->FromUserName)) {
                        $result = $this->dealClick($this->postObj->EventKey);
                    } else {
                        $result = $this->getResponseText($this->postObj, "用户未绑定，请先绑定账户，点击 工具->帮助 或回复帮助查看帮助信息。");
                    }
                }
                break;
            case "scancode_waitmsg" :
                $result = $this->dealScanEvent();
                break;
            default :
                $result = "Unknow Event: " . $this->postObj->Event;
                break;
        }
        return $result;
    }

    /**
     * 处理扫码事件
     * @return mixed
     */
    public function dealScanEvent()
    {
        $this->connectDatabase();
        $str = "用户未绑定，请先绑定账户，点击 工具->帮助 或回复帮助查看帮助信息。";
        if ($this->checkHave($this->postObj->FromUserName)) {
            mysql_select_db($this->homeid);
            $id = $this->postObj->ScanCodeInfo->ScanResult;
            $rr = mysql_query("select device from t_device_stat where id = '{$id}'");
            $dev = mysql_fetch_row($rr);
            if($dev[0] == null){
                $str = "操作失败";
            }else{
                $str = "添加".$dev[0]."操作成功";
                //把状态表置1
                mysql_query("update t_device_stat set flag = 1 where id = '{$id}'");
                //定时任务表置1
                mysql_query("update t_operation_id set timingflag = 1 where id = '{$id}'");
            }
        }
        return $this->getResponseText($this->postObj, $str);
    }

    /**
     * 处理自定义菜单点击事件
     * @param $eventKey
     * @return string
     */
    public function dealClick($eventKey)
    {
        switch ($eventKey) {
            case "statue_device_status" ://查询状态
                $result = "";
                mysql_select_db($this->homeid);
                $query = mysql_query("select device, stat from t_device_stat where flag = 1");
                while ($row = mysql_fetch_row($query)) {
                    $stat = "关";
                    if ($row[1] == 1)
                        $stat = "开";
                    $result = $result . $row[0] . " : " . $stat . "\n";
                }
                $result = $this->getResponseText($this->postObj, $result);
                break;
            case "statue_temp_humi_light" ://温度湿度亮度数据
                mysql_select_db($this->homeid);
                $query = mysql_query("select temperature, humidity, light from t_temp_data");
                $row = mysql_fetch_row($query);
                $result = "温度 : " . $row[0] . "\n湿度 : " . $row[1] . "\n亮度 : " . $row[2];
                $result = $this->getResponseText($this->postObj, $result);
                break;
            case "statue_notice" :
                mysql_select_db($this->homeid);
                $query = mysql_query("select warnning from t_temp_data");
                $row = mysql_fetch_row($query);
                if ($row[0] == 0) {
                    $result = "无通知";
                } else {
                    $result = $row[0];
                }
                $result = $this->getResponseText($this->postObj, $result);
                break;
            case "statue_note" :
                $result = "";
                mysql_select_db($this->homeid);
                $query = mysql_query("select * from t_note");
                while ($row = mysql_fetch_row($query)) {
                    $result = $result . $row[1] . "\n" . $row[0] . "\n";
                }
                $result = $this->getResponseText($this->postObj, $result);
                break;
            case "data_history" ://操作记录
                $result = $this->getResponseTextPic("操作记录", $this->picurloperation, $this->operationhistoryurl . "?homeid=" . $this->homeid);
                break;
            case "temperature" ://温度历史数据
                $result = $this->getResponseTextPic("温度数据", $this->picurlthl, $this->charturl . "?flag=" . $this->postObj->EventKey . "&homeid=" . $this->homeid);
                break;
            case "humidity" ://湿度历史数据
                $result = $this->getResponseTextPic("湿度数据", $this->picurlthl, $this->charturl . "?flag=" . $this->postObj->EventKey . "&homeid=" . $this->homeid);
                break;
            case "light" ://亮度历史数据
                $result = $this->getResponseTextPic("亮度数据", $this->picurlthl, $this->charturl . "?flag=" . $this->postObj->EventKey . "&homeid=" . $this->homeid);
                break;
            case "tool_add_node" ://添加节点
                break;
            default :
                break;
        }
        return $result;
    }

    /**
     * 获得回复消息图文格式
     * @param $murl
     * @return string
     */
    public function getResponseTextPic($title, $mpicurl, $murl)
    {
        $textTpl = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[news]]></MsgType>
            <ArticleCount>1</ArticleCount>
            <Articles>
            <item>
            <Title><![CDATA[%s]]></Title>
            <PicUrl><![CDATA[%s]]></PicUrl>
            <Url><![CDATA[%s]]></Url>
            </item>
            </Articles>
        </xml>";
        $resultStr = sprintf($textTpl, $this->postObj->FromUserName, $this->postObj->ToUserName, time(), $title, $mpicurl, $murl);
        return $resultStr;
    }
}

?>