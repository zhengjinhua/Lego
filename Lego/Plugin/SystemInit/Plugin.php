<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/10
 * Time: 14:06
 */
namespace Plugin\SystemInit;

use Core\Event;
use Core\PluginInterface;

/**
 * 系统初始化插件
 *
 * @package Plugin\SystemInit
 */
class Plugin implements PluginInterface
{
    public static function register()
    {
        Event::attach('CORE.ROUTE.POST', function () {

            //字符集
            header("Content-type: text/html; charset=utf-8");
            //时区
            date_default_timezone_set("Asia/Shanghai");
            //会话
            session_start();

        });

    }
}