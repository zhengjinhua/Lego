<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 16/8/10
 * Time: 14:06
 */
namespace Plugin\ErrorPage;

use Core\Event;
use Core\PluginInterface;
use Core\Router;

/**
 * 404/500跳转接口
 * @package Plugin
 */
class Plugin implements PluginInterface
{
    public static function register()
    {
        Event::attach("CORE.ROUTE.PRE", function () {

            Router::get('/[4-5]\d\d.html', function () {
                echo "ERROR PAGE: {$_SERVER['PATH_INFO']}";
                die;
            });
        });
    }
}