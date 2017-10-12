<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/10
 * Time: 14:06
 */
namespace Plugin\Status;

use Core\Event;
use Core\Router;
use Core\Config;
use Core\Extension;
use Core\PluginInterface;

/**
 * 验证码插件
 * @package Plugin
 */
class Plugin implements PluginInterface
{
    public static function register()
    {
        Event::attach("CORE.ROUTE.PRE", function () {

            if (!isset($_GET['user']) || $_GET['user'] !== 'zhengjinhua') {
                return;
            }
            Router::get('/status', function () {
                $moduleList = Extension::getModuleList();
                $autoLoadPluginList = Extension::$autoLoadPlugin;
                $pluginList = Extension::getPluginList();
                $routerMap = Router::map();
                $eventMap = Event::map();
                $config = Config::get();

                include __DIR__ . '/index.html';
            });
        });
    }
}