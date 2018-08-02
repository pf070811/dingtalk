<?php

/**
 * Created by PhpStorm.
 * User: wangpenghai
 * Date: 2018/8/1
 * Time: 下午7:27
 */
namespace pfDingTalk\Code;

use pfDingTalk\Code\Support\BaseRequest;

class Department extends BaseRequest
{

    /**
     * Get department list.
     *
     * @param int $id
     *
     * @return array
     */
    public function getList(int $id = 0)
    {
        $path = 'department/list';
        if ($id == 0) {
            return $this->httpGet($path, ['access_token'=>$this->config['access_token']]);
        }

        return $this->httpGet($path, compact('id'));
    }

}