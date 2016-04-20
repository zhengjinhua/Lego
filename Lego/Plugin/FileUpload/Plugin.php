<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/10
 * Time: 14:06
 */
namespace Plugin\FileUpload;

use Core\BreakException;
use Core\Event;
use Core\PluginInterface;
use Core\Config;
use Core\Router;

/**
 * 文件上传插件
 *
 * Config::set('FILEUPLOAD', [
 *      'maxSize' => 2097152,
 *      'allowExt' => ['gif', 'jpg', 'jpeg', 'bmp', 'png', 'swf'],
 *      'allowType' => [],
 *      'savePath' => './upload',
 * ]);
 *
 * @package Plugin
 */
class Plugin implements PluginInterface
{
    public static function name()
    {
        return '文件上传插件';
    }

    public static function desc()
    {
        return '文件上传插件';
    }

    public static function register()
    {
        Event::attach("CORE.MODULE.LOAD.PRE", function () {

            /*if ($_SERVER['PATH_INFO'] === '/fileupload') {
                    $File = new File(Config::get('FILEUPLOAD'));
                    $result = $File->upload();
                    json_encode($result,JSON_UNESCAPED_UNICODE);
                    throw new BreakException();
                }*/

            Router::post('/fileupload', function () {
                $File = new File(Config::get('FILEUPLOAD'));
                $result = $File->upload();
                json_encode($result, JSON_UNESCAPED_UNICODE);
            });
        });
    }
}