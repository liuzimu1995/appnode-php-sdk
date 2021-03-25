<?php
/**
 * copyright (C) 2015-2021 广州群应用网络科技有限公司
 * link: https://api.ibos.cn/
 * author: liuzimu1995
 * date: 2021/3/25/025 15:23
 *
 * If the implementation is hard to explain, it's a bad idea.
 * If the implementation is easy to explain, it may be a good idea.
 */

namespace appnodesdk;

class Api
{
    /**
     * 公共参数
     * @link https://www.kancloud.cn/appnode/apidoc/497814
     */
    const COMMON_PARAM = [
        'api_format' => 'json', // API 返回结果的格式，支持 json 或 jsonp，默认为 json。
        'api_lang' => 'zh_cn', // API 返回结果的语言。支持 zh_cn 和 en_us，默认为 en_us。
    ];

    /**
     * 查看系统信息 Status.Overview
     */
    const STATUS_VIEW = [
        'api_agent_app' => 'sysinfo',
        'api_action' => 'Status.Overview',
    ];

    /** 节点管理,nodemgr **/
    Const NODE_LIST = [
        'api_ccenter_app' => 'nodemgr',
        'api_action' => 'Node.List1',
    ];
}