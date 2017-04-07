<?php
include_once "Class.WeChatMsg.php";
responseMsg($GLOBALS["HTTP_RAW_POST_DATA"]);

/**
 * 处理消息入口
 * @param $postStr
 */
function responseMsg($postStr)
{
    if (!empty($postStr)) {
        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        $RX_TYPE = trim($postObj->MsgType);
        switch ($RX_TYPE) {
            case "text":
                $obj = new TextMsg($postObj);
                $resultStr = $obj->handleMsg();
                break;
            case "event":
                $obj = new EventMsg($postObj);
                $resultStr = $obj->handleMsg();
                break;
            case "voice":
                $obj = new VoiceMsg($postObj);
                $resultStr = $obj->handleMsg();
                break;
            default:
                $resultStr = "Unknow msg type: " . $RX_TYPE;
                break;
        }
        echo $resultStr;
    } else {
        echo "";
        exit;
    }
}

?>