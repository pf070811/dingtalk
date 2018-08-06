<?php

/**
 * Created by PhpStorm.
 * User: wangpenghai
 * Date: 2018/8/1
 * Time: 下午7:27
 */
namespace pfDingTalk\Code;

use pfDingTalk\Code\Support\BaseRequest;

class Message extends BaseRequest
{
    /**
     * 钉钉发送普通消息
     *
     * @param array $urlParam
     * @return boolean
     */
    public function sendMsg(array $params)
    {
        $path = 'message/send?access_token=' . $this->config['access_token'];

        $toData = [];
        $toData['touser'] = $params['touser'] ?? '';
        $toData['toparty'] = $params['toparty'] ?? '';
        $toData['agentid'] = $this->config['agentid'];
        $toData['msgtype'] = $params['msgtype'] ?? 'text';
        $toData[$toData['msgtype']] = $params[$toData['msgtype']] ?? [];
        $info = $this->httpPost($path, json_encode($toData));
        return $info;
    }

}