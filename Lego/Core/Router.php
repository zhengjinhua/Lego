<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/11
 * Time: 19:16
 */

namespace Core;

class Router
{
    private static $map = [];

    /**
     * 注册GET路由
     *
     * @param string $pattern
     * @param callback $callback
     */
    public static function get($pattern, $callback)
    {
        self::register('GET', $pattern, $callback);
    }

    /**
     * 注册POST路由
     *
     * @param $pattern
     * @param $callback
     */
    public static function post($pattern, $callback)
    {
        self::register('POST', $pattern, $callback);
    }

    /**
     * 注册mixed路由
     *
     * @param $pattern
     * @param $callback
     */
    public static function mixed($pattern, $callback)
    {
        self::register('GET', $pattern, $callback);
        self::register('POST', $pattern, $callback);
    }

    /**
     * 注册路由匹配模式
     *
     * @param string $method HTTP方法
     * @param string $pattern 匹配模式
     * @param callback $callback 回调函数
     * @throws \Exception
     */
    public static function register($method, $pattern, $callback)
    {
        if (empty($method) || empty($pattern)) {
            throw new \Exception("ROUTER REGISTER ERROR : {$method} {$pattern}", 500);
        }
        $isPreg = strpos($pattern, '(');
        $isPreg && self::$map[$method]['preg'][$pattern] = $callback;
        $isPreg || self::$map[$method]['string'][$pattern] = $callback;
    }

    /**
     * 根据PATH_INFO路由
     * @return array
     * @throws \Exception
     */
    public static function match()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $pathInfo = $_SERVER['PATH_INFO'];
        if (isset(self::$map[$method]['string'][$pathInfo])) {
            return array(self::$map[$method]['string'][$pathInfo], []);
        } else {
            if (isset(self::$map[$method]['preg'])) {
                foreach (self::$map[$method]['preg'] as $pattern => $callback) {
                    $pattern = str_replace('.html', '\.html', $pattern);
                    if (preg_match('#^' . $pattern . '$#', $pathInfo, $matches) === 1) {
                        array_shift($matches);
                        return array($callback, $matches);
                    }
                }
            }
        }
        throw new \Exception("{$method} {$pathInfo} 404 NOT FIND", 404);
    }

    /**
     * 获取注册表
     *
     * @return array
     */
    public static function map()
    {
        static $rowMap = [];
        if (!$rowMap) {
            foreach (self::$map as $method => $splitArray) {
                $rowMap[$method] = isset($splitArray['preg']) ? $splitArray['preg'] : [];
                $rowMap[$method] += isset($splitArray['string']) ? $splitArray['string'] : [];
            }
        }

        return $rowMap;
    }

} 