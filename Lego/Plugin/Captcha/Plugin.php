<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/10
 * Time: 14:06
 */

namespace Plugin\Captcha;

use Core\Event;
use Core\Router;
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

            Router::get('/captcha', function () {
                $captcha = new Captcha(140, 40, 4);
                $captcha->showImage();
                $_SESSION['captcha'] = $captcha->getCode();
            });
        });
    }
}