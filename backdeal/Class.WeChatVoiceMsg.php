<?php

/**
 * 处理语音消息
 * Class VoiceMsg
 */
class VoiceMsg extends Msg
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
     * 处理语音消息
     * @return mixed
     */
    public function handleMsg()
    {
        $this->connectDatabase();
        if ($this->checkHave($this->postObj->FromUserName)) {
            $contentStr = SendAndRecMsg("1/13/" . $this->homeid . "/" . $this->postObj->Recognition);
            if ($contentStr == "指令未识别") {
                $contentStr = getAIResult($this->postObj->Recognition);
            }
        } else {
            $contentStr = "用户未绑定，请先绑定账户，点击 工具->帮助 查看帮助信息。";
        }
        $resultStr = $this->getResponseText($this->postObj, $contentStr);
        return $resultStr;
    }
}

?>