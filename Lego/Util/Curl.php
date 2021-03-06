<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/23
 * Time: 14:53
 */
namespace Util;

use Core\Log;

class Curl
{
    static function get($url)
    {
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);//严格校验
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        $return = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if($return === false){
            $msg =curl_error($ch);
            Log::error("curl_error:{$msg}:{$url}");
        }

        curl_close($ch);

        if ($httpCode !== 200) {
            return false;
        }

        return $return;
    }

    static function post($url, $params)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);//严格校验
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        $return = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if($return === false){
            $msg =curl_error($ch);
            Log::error("curl_error:{$msg}:{$url}");
        }

        curl_close($ch);

        if ($httpCode !== 200) {
            return false;
        }

        return $return;
    }

}