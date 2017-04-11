<?php

namespace Module\ModuleName;

use Core\Router;
use Core\ModuleInterface;

class Module implements ModuleInterface
{
    public static function init()
    {
        Router::get('/ControllerName/index', '\Module\ModuleName\Controller\ControllerName::index');
        Router::mixed('/ControllerName/add', '\Module\ModuleName\Controller\ControllerName::add');
        Router::mixed('/ControllerName/modify/(\d+)', '\Module\ModuleName\Controller\ControllerName::modify');
        Router::get('/ControllerName/delete/(\d+)', '\Module\ModuleName\Controller\ControllerName::delete');
    }
}