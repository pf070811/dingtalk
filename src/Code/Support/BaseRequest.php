<?php

/**
 * Created by PhpStorm.
 * User: wangpenghai
 * Date: 2018/8/2
 * Time: 上午11:54
 */
namespace pfDingTalk\Code\Support;

use pfDingTalk\Application;

class BaseRequest
{

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->httpRequest = $app->httpRequest();
        $this->config = $app->getConfig();
    }

    /**
     * http get
     */
    public function httpGet($path, $urlParam=[], $format='json')
    {
        $requestUrlString = '';
        foreach ($urlParam as $k => $v) {
            $requestUrlString .= $k."=".urlencode($v)."&";
        }

        $requestUrlString = rtrim($requestUrlString, '&');
        $path .= '?' . $requestUrlString;
        $response = $this->httpRequest->request('get',$path);

        $body = $response->getBody();
        if ($responseCode = $response->getStatusCode() != 200)
        {
            throw new \Exception('http fail! code=' . $responseCode);
        } else {
            if ($format === 'json')
            {
                $data = json_decode($body, true);
                return $data;
            } else {
                return $body;
            }
        }
    }
    /**
     * http post
     */
    public function httpPost($path, $urlParam=[], $format='json')
    {

        $response = $this->httpRequest->request('post',$path,['body' => $urlParam]);

        $body = $response->getBody();
        if ($responseCode = $response->getStatusCode() != 200)
        {
            throw new \Exception('http fail! code=' . $responseCode);
        } else {
            if ($format === 'json')
            {
                $data = json_decode($body, true);
                return $data;
            } else {
                return $body;
            }
        }
    }

}