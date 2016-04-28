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
    private static $rewrite = [];

    public static function rewrite($pattern, $next){
        if (empty($pattern) || empty($next)) {
            throw new \Exception("ROUTER REWRITE ERROR : {$pattern} {$next}", 500);
        }
        self::$rewrite[$pattern] = $next;
    }

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

        foreach(self::$rewrite as $pattern=>$next){
            if(preg_match('#^' . $pattern . '$#', $pathInfo)){
                $pathInfo = preg_replace('#^' . $pattern . '$#',$next);
            }
        }

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
     * 系统内URL生成
     * @param array|string $pathArr callback or path_info and args
     * @param array $get 参数列表
     * @return string
     */
    public static function url($pathArr, $get = [])
    {
        static $cache = [];

        if (is_array($pathArr)) {
            $cacheKey = md5(json_encode($pathArr));
            if (isset($cache[$cacheKey])) {
                $pathInfo = $cache[$cacheKey];
            } else {
                $callback = array_shift($pathArr);
                foreach (self::map() as $set) {
                    $pathInfo = array_search($callback, $set);
                    if ($pathInfo !== false) {
                        break;
                    }
                }
                if ($pathInfo === false) {
                    trigger_error("{$callback} URL ERROR");
                    return '';
                }
                if ($pathArr) {
                    foreach ($pathArr as $v) {
                        $pathInfo = preg_replace('#\([^\(]*\)#', $v, $pathInfo, 1);
                    }
                }
                $pathInfo = $cache[$cacheKey] = preg_replace('#\([^\(]*\)#', '', $pathInfo);
            }

        } else {
            $pathInfo = $pathArr;
        }

        //URL重写
        $protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
        if (Config::get('URL_REWRITE')) {
            $pathInfo = $protocol . $_SERVER['HTTP_HOST'] . $pathInfo;
        } else {
            $pathInfo = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . $pathInfo;
        }

        if ($get) {
            $pathInfo .= '?' . http_build_query($get);
        }

        return $pathInfo;
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