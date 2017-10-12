<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/10
 * Time: 14:06
 */
namespace Plugin\ImageServe;

use Core\Event;
use Core\Router;
use Core\Config;
use Core\PluginInterface;

/**
 * HTML压缩
 * @package Plugin\ImageServe
 */
class Plugin implements PluginInterface
{
    public static function register()
    {

        Config::set('IMAGE_SERVE_CONFIG', [
            'storage' => 'ftp',//'local'
            'ftp' => [
                'hostname' => 'database.test.com',
                'port' => '21',
                'username' => 'FTP_USER_PHP',
                'password' => '3E8RIa92cb99',
            ],
            'allowExt' => ['gif', 'jpg', 'jpeg', 'bmp', 'png', 'swf'],
            'savePath' => 'game',   //文件显示目录
            'showPath' => '//image.test.com/game',   //文件显示目录
        ]);

        Event::attach("CORE.ROUTE.PRE", function () {

            Router::get('/uploadFile/index/(\w+)', function ($flag) {
                include __DIR__ . '/popwin.html';
            });


            Router::post('/uploadFile', function () {
                $ImageServer = new ImageServer();
                $ImageServer->uploadFile();
            });

        });
    }
}