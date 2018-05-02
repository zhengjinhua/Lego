<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/21
 * Time: 11:18
 */

namespace Module\Demo;

use Core\Router;
use Core\ModuleInterface;

class Module implements ModuleInterface
{
    /**
     * @return mixed|void
     * @throws \Exception
     */
    public static function init()
    {

        Router::get('/api', function () {
            echo "api";
        });

        Router::get('/demo/(\d+)', "\Module\Demo\Controller\Index::index");

    }

}