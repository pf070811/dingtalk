<?php

/**
 * Created by PhpStorm.
 * User: wangpenghai
 * Date: 2018/8/1
 * Time: 下午7:27
 */
namespace pfDingTalk\Code;

use pfDingTalk\Code\Support\BaseRequest;

class Token extends BaseRequest
{

    /**
     * 获取缓存后的accessToken
     */
    public function get()
    {
        $data['corpid'] = $this->config['corpid'];
        $data['corpsecret'] = $this->config['corpsecret'];
        $info = $this->httpGet('gettoken', $data);
        return $info;
    }
}