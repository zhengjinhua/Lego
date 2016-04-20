<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/11
 * Time: 16:20
 */

namespace Module\Status;

use Core\ModuleInterface;
use Core\Router;

class Module implements ModuleInterface
{
    public static function name()
    {
        return 'Core Module';
    }

    public static function desc()
    {
        return 'Core Module';
    }

    public static function init()
    {
        Router::get('/status', '\Module\Status\Controller\Index::index');
    }
}