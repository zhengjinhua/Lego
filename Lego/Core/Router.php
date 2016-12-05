<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/11
 * Time: 19:16
 */

namespace Core {

    /**
     * 路由类
     * @package Core
     */
    class Router
    {
        private static $map = [];

        /**
         * 注册CLI路由
         *
         * @param string $pattern
         * @param callback $callback
         */
        public static function cli($pattern, $callback)
        {
            self::register('CLI', $pattern, $callback);
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
                throw new \Exception("ROUTER REGISTER ERROR : {$method} {$pattern}", 605);
            }
            self::$map[$method][$pattern] = $callback;
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

            if (isset(self::$map[$method])) {
                if (isset(self::$map[$method][$pathInfo])) {
                    return array(self::$map[$method][$pathInfo], []);
                } else {
                    foreach (self::$map[$method] as $pattern => $callback) {
                        $pattern = str_replace('.html', '\.html', $pattern);
                        if (preg_match('#^' . $pattern . '$#', $pathInfo, $matches) === 1) {
                            array_shift($matches);
                            return array($callback, $matches);
                        }
                    }
                }
            }

            throw new \Exception("{$method} {$pathInfo} NOT FIND", 604);
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
            return self::$map;
        }

    }
}

namespace {
    /**
     * URL生成简易方法
     * @param $pathArr
     * @param array $get
     * @return string
     */
    function url($pathArr, $get = [])
    {
        return \Core\Router::url($pathArr, $get);
    }
}