<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/10
 * Time: 14:06
 */
namespace Plugin\TimeSpend;

use Core\Event;
use Core\Config;
use Core\PluginInterface;

/**
 * 程序运行耗时调试
 * @package Plugin\TimeSpend
 */
class Plugin implements PluginInterface
{
    public static function register()
    {
        if (!isset($_GET['TIMESPEND'])) {
            return;
        }

//        $SYS_KEY = Config::get('SYS_KEY');
//        if (!isset($_GET['SKEY']) || $_GET['SKEY'] !== substr($SYS_KEY,0,6)) {
//            return;
//        }

        //程序运行耗时
        Event::attach('CORE.REQUEST.OVER', function () {
            echo "<script>console.log('TimeSpend: " . round((microtime(1) - $_SERVER['REQUEST_TIME_FLOAT']) * 1000, 3) . "ms')</script>";
        });

    }
}