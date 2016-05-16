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

/**
 * 应用信息模块
 * @package Module\Status
 */
class Module implements ModuleInterface
{
    public static function init()
    {
        Router::get('/status', '\Module\Status\Controller\Index::index');
    }
}