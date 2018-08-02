<?php

/**
 * Created by PhpStorm.
 * User: wangpenghai
 * Date: 2018/8/1
 * Time: 下午7:27
 */
namespace pfDingTalk\Code;

use pfDingTalk\Code\Support\BaseRequest;

class User extends BaseRequest
{

    /**
     * 获取钉钉成员想起
     *
     * @param
     * @return array
     */
    public function getInfo(int $userId)
    {
        if(!$userId) {
            return [];
        }
        $path = 'user/get';
        $data = [
            'access_token' => $this->config['access_token'],
            'userid' => $userId
        ];
        $info = $this->httpGet($path, $data);

        return $info;
    }

    /**
     * 获取钉钉部门成员列表
     *
     * @param
     * @return array
     */
    public function getDepartmentUser(int $departmentId)
    {
        if(!$departmentId) {
            return [];
        }
        $path = 'user/list';
        $data = [
            'access_token' => $this->config['access_token'],
            'department_id' => $departmentId
        ];
        $info = $this->httpGet($path, $data);

        return $info;
    }
}