<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/31
 * Time: 10:54
 */

namespace Util;

/**
 * 过滤类
 */
class Filter
{
    public static function filterVar($value, $filter, $options = null)
    {
        return filter_var($value, $filter, $options);
    }

    public static function filterVarArray($value, $definition, $add_empty = false)
    {
        return filter_var_array($value, $definition, $add_empty);
    }

    public static function sanitizeUrlEncode($value)
    {
        return filter_var($value, FILTER_SANITIZE_ENCODED);
    }

    public static function sanitizeHtmlEncode($value)
    {
        return filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public static function sanitizeEmail($value)
    {
        return filter_var($value, FILTER_SANITIZE_EMAIL);
    }

    public static function sanitizeNumbers($value)
    {
        return filter_var($value, FILTER_SANITIZE_NUMBER_INT);
    }

    public static function sanitizeString($value)
    {
        return filter_var($value, FILTER_SANITIZE_STRING);
    }

    public static function validateIP($ip)
    {
        return filter_var($ip, FILTER_VALIDATE_IP);
    }

    public static function validateMac($mac)
    {
        return filter_var($mac, FILTER_VALIDATE_MAC);
    }

    public static function validateUrl($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    public static function validateEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function validateJson($jsonString)
    {
        return is_object(json_decode($jsonString));
    }

    public static function validateCn($string)
    {
        return !!preg_match('/[\x{4e00}-\x{9fa5}]/u', $string);
    }

    public static function validateMobile($mobile)
    {
        return !!preg_match('/^1[34578]\d{9}$/', $mobile);
    }

    public static function validateIDCard($IDCard)
    {
        if (strlen($IDCard) == 18) {
            return self::check18IDCard($IDCard);
        } elseif ((strlen($IDCard) == 15)) {
            $IDCard = self::convertIDCard15to18($IDCard);
            return self::check18IDCard($IDCard);
        } else {
            return false;
        }
    }

    //计算身份证的最后一位验证码,根据国家标准GB 11643-1999
    private static function calcIDCardCode($IDCardBody)
    {
        if (strlen($IDCardBody) != 17) {
            return false;
        }

        //加权因子
        $factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
        //校验码对应值
        $code = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
        $checksum = 0;

        for ($i = 0; $i < strlen($IDCardBody); $i++) {
            $checksum += substr($IDCardBody, $i, 1) * $factor[$i];
        }

        return $code[$checksum % 11];
    }

    // 将15位身份证升级到18位
    private static function convertIDCard15to18($IDCard)
    {
        if (strlen($IDCard) != 15) {
            return false;
        } else {
            // 如果身份证顺序码是996 997 998 999，这些是为百岁以上老人的特殊编码
            if (array_search(substr($IDCard, 12, 3), array('996', '997', '998', '999')) !== false) {
                $IDCard = substr($IDCard, 0, 6) . '18' . substr($IDCard, 6, 9);
            } else {
                $IDCard = substr($IDCard, 0, 6) . '19' . substr($IDCard, 6, 9);
            }
        }
        $IDCard = $IDCard . self::calcIDCardCode($IDCard);
        return $IDCard;
    }

    // 18位身份证校验码有效性检查
    private static function check18IDCard($IDCard)
    {
        if (strlen($IDCard) != 18) {
            return false;
        }

        $IDCardBody = substr($IDCard, 0, 17); //身份证主体
        $IDCardCode = strtoupper(substr($IDCard, 17, 1)); //身份证最后一位的验证码

        if (self::calcIDCardCode($IDCardBody) != $IDCardCode) {
            return false;
        } else {
            return true;
        }
    }

}
