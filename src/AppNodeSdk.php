<?php
/**
 * copyright (C) 2015-2021 广州群应用网络科技有限公司
 * link: https://api.ibos.cn/
 * author: liuzimu1995
 * date: 2021/3/25/025 15:22
 *
 * If the implementation is hard to explain, it's a bad idea.
 * If the implementation is easy to explain, it may be a good idea.
 */

namespace appnodesdk;

class AppNodeSdk
{
    private $host;
    private $token;
    private $isDebug = 0; // 是否debug请求

    /**
     * AppNodeSdk constructor.
     * @param string $host AppNode 分为两个API地址，第一种是受控端，第二种是控制中心，
     * 控制中心的全局参数中需要 api_ccenter_app
     * 受控端的全局参数中需要 api_agent_app
     * 切记，两个端口不同
     * @param $token
     */
    public function __construct($host, $token)
    {
        $this->host = $host;
        $this->token = $token;
    }

    /**
     * @return int
     */
    public function getIsDebug()
    {
        return $this->isDebug;
    }

    /**
     * @param int $isDebug
     * @return $this
     */
    public function setIsDebug($isDebug)
    {
        $this->isDebug = $isDebug;
        return $this;
    }

    public function get(array $params)
    {
        $params['api_debug'] = $this->isDebug;
        $client = new \GuzzleHttp\Client();
        $url = $this->buildUrl($params);
//        var_dump($url);die;
        try {
            $response = $client->request('GET', $url);
        } catch (\Exception $e) {
            throw new AppNodeException('Network error：网络错误,' . $e->getMessage(), $e->getCode());
        }
        $json = $response->getBody()->getContents();
        $data = \GuzzleHttp\json_decode($json, true);
        if (empty($data)) {
            throw new AppNodeException('未知错误: 接口无法解析', 404);
        }
        if ($data['CODE'] != 'ok') {
            throw new AppNodeException("接口错误:\n" . $json, 200);
        }
        return $data['DATA'];
    }

    public function buildUrl(array $params)
    {
        return $this->host . '?' . Sign::sign($params, $this->token);
    }
}