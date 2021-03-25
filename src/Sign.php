<?php
/**
 * copyright (C) 2015-2021 广州群应用网络科技有限公司
 * link: https://api.ibos.cn/
 * author: liuzimu1995
 * date: 2021/3/25/025 15:36
 *
 * If the implementation is hard to explain, it's a bad idea.
 * If the implementation is easy to explain, it may be a good idea.
 */

namespace appnodesdk;

/**
 * 签名方法
 * https://www.kancloud.cn/appnode/apidoc/497816
 * Class Sign
 * @package appnodesdk
 */
class Sign
{
    /**
     * 签名方法
     * @param $params
     * @param $token
     * @return string
     */
    public static function sign(array $params, $token)
    {
        $params['api_timestamp'] = time();
        $params['api_nonce'] = self::getRandom(16);
        $params = array_merge($params, Api::COMMON_PARAM);
        ksort($params);
        $data = [];
        foreach ($params as $key => &$item) {
            $data[] = urlencode($key) . '=' . urlencode($item);
        }
        $str = implode('&', $data);
        $signStr = self::HmacMd5($str, $token);
        $data[] = 'api_sign=' . $signStr;
        return implode('&', $data);
    }

    /**
     * 获取随机字符串
     * @param integer $length 要多少位
     * @param integer $numeric 是否只要数字
     * @return string 随机产生的字符串
     */
    public static function getRandom($length, $numeric = 0)
    {
        $seed = base_convert(md5(microtime()), 16, $numeric ? 10 : 35);
        $seed = $numeric ? (str_replace('0', '', $seed) . '012340567890') : ($seed . 'zZ' . strtoupper($seed));
        $hash = '';
        $max = strlen($seed) - 1;
        for ($index = 0; $index < $length; $index++) {
            $hash .= $seed{mt_rand(0, $max)};
        }
        return $hash;
    }

    /**
     * 签名方法
     * @param $data
     * @param $key
     * @return string
     */
    public static function HmacMd5($data, $key)
    {
        if (function_exists('hash_hmac')) {
            return hash_hmac('md5', $data, $key);
        }
        $key = (strlen($key) > 64) ? pack('H32', 'md5') : str_pad($key, 64, chr(0));
        $ipad = substr($key, 0, 64) ^ str_repeat(chr(0x36), 64);
        $opad = substr($key, 0, 64) ^ str_repeat(chr(0x5C), 64);
        return md5($opad . pack('H32', md5($ipad . $data)));
    }
}