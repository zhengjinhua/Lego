<?php
/**
 * Created by IntelliJ IDEA.
 * User: zjh
 * Date: 2018/4/14
 * Time: 21:08
 */

namespace Core;


class Env
{
    private static $env = [];

    public static function get($key)
    {
        return isset(self::$env[$key]) ? self::$env[$key] : '';
    }

    public static function init()
    {
        if (PHP_SAPI === 'cli') {

            self::$env['REQUEST_METHOD'] = 'CLI';
            self::$env['PATH_INFO'] = isset($_SERVER['argv'][1]) ? $_SERVER['argv'][1] : '/';

        } else {

            self::$env['REQUEST_METHOD'] = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
            self::$env['PATH_INFO'] = !empty($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';

        }

        self::$env['HTTP_HOST'] = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
        self::$env['REQUEST_TIME'] = isset($_SERVER['REQUEST_TIME']) ? $_SERVER['REQUEST_TIME'] : time();
    }
}