<?php

/**
 * Created by PhpStorm.
 * User: wangpenghai
 * Date: 2018/8/1
 * Time: 下午6:08
 */
namespace pfDingTalk;

use Exception;
use GuzzleHttp\Client;

class Application
{
    /**
     * 实例容器
     */
    protected $instanceMap = [];
    /**
     * 配置文件
     */
    protected $config = [
        'oapi_host' => 'https://oapi.dingtalk.com/',
        'corpid' => '',
        'corpsecret' => '',
        'agentid' => '',
        'noncestr' => '',
        'access_token' => '',
    ];

    /**
     * @var array
     */
    protected $providers = [
        'user' => Code\User::class,
        'department' => Code\Department::class,
        'token' => Code\Token::class,
        'message' => Code\Message::class,
    ];

    /**
     * Application constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = array_merge($this->config, $config);
        if (empty($this->config['access_token']))
        {
            $tokenInfo = $this->getTokenInfo();
            $token = $tokenInfo['access_token']??'';
            $this->setAccessToken($token);
        }
    }
    /**
     * Application setToken
     *
     * @return array
     */
    public function setAccessToken($token)
    {
        if (!empty($token))
        {
            $this->config['access_token'] = $token;
        }
    }
    /**
     * Application getTokenInfo
     *
     * @return array
     */
    public function getTokenInfo()
    {
        return $this->token->get();
    }
    /**
     * Application Config
     *
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * 生成签名
     *
     * @param type $ticket
     * @param type $nonceStr
     * @param type $timeStamp
     * @param type $url
     * @return type
     */
    public function sign($ticket, $nonceStr, $timeStamp, $url)
    {
        $plain = 'jsapi_ticket=' . $ticket .
            '&noncestr=' . $nonceStr .
            '&timestamp=' . $timeStamp .
            '&url=' . $url;
        return sha1($plain);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function __get($key)
    {
        if (isset($this->instanceMap[$key]) && is_object($this->instanceMap[$key]))
        {
            return $this->instanceMap[$key];
        }

        $provider = $this->providers[$key]??'';
        if (!empty($provider))
        {
            $this->instanceMap[$key] = new $provider($this);
            return $this->instanceMap[$key];
        } else {
            throw new Exception('not found ' . $key . "\n");
        }
    }

    public function httpRequest()
    {
        if (isset($this->instanceMap['httpRequest']) && is_array($this->instanceMap['httpRequest']))
        {
            return $this->instanceMap['httpRequest'];
        }
        return $this->instanceMap['httpRequest'] = new Client([
            'base_uri' => $this->config['oapi_host'],
        ]);
    }
}