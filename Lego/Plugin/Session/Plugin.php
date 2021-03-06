<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/10
 * Time: 14:06
 */

namespace Plugin\Session;

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
        Event::attach('CORE.REQUEST.INIT', function () {
            //会话
            session_start();
        }, true);

    }
}