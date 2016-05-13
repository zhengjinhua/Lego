<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/10
 * Time: 14:06
 */
namespace Plugin\Captcha;

use Core\Extension;
use Core\Event;
use Core\PluginInterface;
use Core\Router;

/**
 * 验证码插件
 * @package Plugin
 */
class Plugin implements PluginInterface
{
    public static function register()
    {
        Event::attach("CORE.MODULE.LOAD.PRE", function () {

            /*if($_SERVER['PATH_INFO'] === '/captcha'){
                $Captcha = new Captcha(140,40,4);
                $Captcha->showImage();
                $_SESSION['captcha'] = $Captcha->getCode();
                Extension::breakToMain();
            }*/

            Router::get('/captcha', function () {
                $Captcha = new Captcha(140, 40, 4);
                $Captcha->showImage();
                $_SESSION['captcha'] = $Captcha->getCode();
            });
        });
    }
}