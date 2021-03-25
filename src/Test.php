<?php

use appnodesdk\AppNodeSdk;
use appnodesdk\Sign;

require "../vendor/autoload.php";

//$ret = \appnodesdk\Sign::HMAC_MD5('api_action=Status.Overview&api_agent_app=sysinfo&api_format=json&api_lang=zh_cn&api_nonce=8YyjYz9t6H3ZVraY&api_timestamp=1515502060', '95bAzsK4AuYbrEnFjfUGdku5CXz2yKJn');
//var_dump($ret);
//die;
//echo \appnodesdk\Sign::sign([], 'Kk44lOCMYRd5RetmRid97wpwKbITQgLf');

/** 签名 **/
//$params = explode('&', 'api_format=json&api_action=Status.Overview&api_agent_app=sysinfo&api_lang=zh_cn&api_nonce=8YyjYz9t6H3ZVraY&api_timestamp=1515502060');
//$data = [];
//foreach ($params as $item) {
//    list($key, $val) = explode('=', $item);
//    $data[$key] = $val;
//}
//$data = array_reverse($data, true);
//echo Sign::sign($data, '95bAzsK4AuYbrEnFjfUGdku5CXz2yKJn');
/** 签名 **/

/** SDK */
$sdk = new AppNodeSdk('http://172.21.72.42:8899', 'bffBbHazdabi2VysSWz3Gnuk7F0VWV40');
$ret = $sdk->setIsDebug(1)->get(\appnodesdk\Api::NODE_LIST);
var_dump($ret);die;
