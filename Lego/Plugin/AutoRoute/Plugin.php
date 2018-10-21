<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/10
 * Time: 14:06
 */

namespace Plugin\AutoRoute;

use Core\Env;
use Core\Event;
use Core\Router;
use Core\PluginInterface;

/**
 * 自动路由
 * @package Plugin
 */
class Plugin implements PluginInterface
{
    public static function register()
    {
        Event::attach("CORE.ROUTE.PRE", function () {
            $pathInfo = Env::get("PATH_INFO");
            if (preg_match("#^/([A-Z][a-zA-Z0-9-_]+)/([A-Z][a-zA-Z0-9-_]+)/([a-zA-Z][a-zA-Z0-9-_]+)#", $pathInfo, $matches)) {

                $preg = preg_replace("#/([^/]+)#", "/(\\w+)", str_replace($matches[0], '', $pathInfo), 10);

                $calback = "\\Module\\{$matches[1]}\\Controller\\{$matches[2]}::{$matches[3]}";

                Router::register(Env::get("REQUEST_METHOD"), $matches[0] . $preg, $calback);
            }
        });
    }
}