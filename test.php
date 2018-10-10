<?php
/**
 * Created by PhpStorm.
 * User: wangpenghai
 * Date: 2018/8/1
 * Time: 上午11:24
 */
require_once __DIR__ . '/vendor/autoload.php';

use pfDingTalk\Application;
$config = [
    'oapi_host' => 'https://oapi.dingtalk.com/',
    'corpid' => 'ding71d0a44ce9b1264635c2f4657eb6378f',//E正式
    'corpsecret' => 'OOnJNJ8JaXhRrQyrseXUsAs7UqWjD23sEigYSI6zAuzQGITjhnaXD15mgbZL_d64',//E正式
    'agentid' => 180168300,//E正式
    'noncestr' => 'hxsdabcd1234',
    'access_token' => '',
];

$client = new Application($config);

#获取token token 缓存自己存一下。
//try{
//
//    $tokenInfo = $client->token->get();
//    var_export($tokenInfo);
//    $token = $tokenInfo['access_token']??'';
//    $ttl = $tokenInfo['expires_in']??'';
//    $client->setAccessToken($token);
//    // Cache::set('ding_talk_token', $token, $ttl-200);
//} catch (Exception $e)
//{
//    var_export($e->getMessage());
//}

#获取部门列表
//try{
//    $departmentData = $client->department->getList();
//    var_export($departmentData);
//} catch (Exception $e)
//{
//    var_export($e->getMessage());
//}

#获取部门用户
//try{
//    $data = $client->user->getDepartmentUser('51385115');
//    var_export($data);
//} catch (Exception $e)
//{
//    var_export($e->getMessage());
//}

#发送消息
try{
    $msg = [
        'touser' => '24000542529709779',
        'msgtype' => 'text',
        'text' => ['content' => 'hello world'],
    ];
    $data = $client->message->sendMsg($msg);
    var_export($data);
} catch (Exception $e)
{
    var_export($e->getMessage());
}
