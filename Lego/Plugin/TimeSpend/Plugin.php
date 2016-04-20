<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/10
 * Time: 14:06
 */
namespace Plugin\TimeSpend;

use Core\Event;
use Core\PluginInterface;

class Plugin implements PluginInterface
{
    public static function name()
    {
        return '程序运行耗时';
    }

    public static function desc()
    {
        return '程序运行耗时';
    }

    public static function register()
    {
        //程序运行耗时
        Event::attach('CORE.REQUEST.OVER', function () {
            echo "<script>console.log('TimeSpend: ".round((microtime(1) - $_SERVER['REQUEST_TIME_FLOAT']) * 1000,3)."ms')</script>";
        });

    }
}