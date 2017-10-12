<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/10
 * Time: 14:06
 */
namespace Plugin\HTML;

use Core\Event;
use Core\Config;
use Core\Extension;
use Core\PluginInterface;

/**
 * 请求静态化
 *
 * 静态化文件目录配置 Config::set('HTML_DIR', APP_PATH . '/html');
 *
 * @package Plugin
 */
class Plugin implements PluginInterface
{
    private static $lifeTime;
    private static $htmlFile;

    public static function register()
    {
        if (empty($_SERVER['HTTP_HOST'])) {
            return;
        }

        //AFTER_ROUTE阶段检测静态化需求
        Event::attach('CORE.ACTION.RUN.PRE', function ($Controller) {

            if (!property_exists($Controller, 'staticActionList')) {
                return;
            }

            $action = $Controller->action;
            $staticActionList = $Controller->staticActionList;

            if (isset($staticActionList[$action]) && (substr($_SERVER['PATH_INFO'], -5) === '.html' || $_SERVER['PATH_INFO'] === '/')) {

                self::$lifeTime = $staticActionList[$action];

                $htmlPath = Config::get('HTML_DIR');
                $htmlPath || $htmlPath = APP_PATH . "/Var/html/{$_SERVER['HTTP_HOST']}";

                $path = $htmlPath . substr($_SERVER['PATH_INFO'], 0, strrpos($_SERVER['PATH_INFO'], '/'));
                if (!is_dir($path)) {
                    mkdir($path, 0777, true);
                }

                $fileName = $_SERVER['PATH_INFO'] === '/' ? '/index.html' : $_SERVER['PATH_INFO'];
                self::$htmlFile = $htmlPath . $fileName;
                if (is_file(self::$htmlFile) && filemtime(self::$htmlFile) > $_SERVER['REQUEST_TIME'] - self::$lifeTime) {
                    require(self::$htmlFile);
                    Extension::breakToMain();
                }

                //开启输出控制
                ob_start();

                //AFTER_ACTION_RUN阶段捕获输出,写入html文件
                Event::attach('CORE.ACTION.RUN.POST', function ($Controller) {
                    $content = ob_get_flush();
                    if (!is_file(self::$htmlFile) || filemtime(self::$htmlFile) < $_SERVER['REQUEST_TIME'] - self::$lifeTime) {
                        file_put_contents(self::$htmlFile, $content);
                    }
                });
            }
        });
    }
}