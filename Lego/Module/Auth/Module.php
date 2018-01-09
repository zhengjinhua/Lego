<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/4
 * Time: 13:17
 */

namespace Module\Auth;

use Core\Router;
use Core\ModuleInterface;

/**
 * 权限管理模块
 * @package Module\Auth
 */
class Module implements ModuleInterface
{
    public static function init()
    {
        //角色CURD
        Router::get('/Auth/Role/index', '\Module\Auth\Controller\Role::index');
        Router::mixed('/Auth/Role/add', '\Module\Auth\Controller\Role::add');
        Router::mixed('/Auth/Role/update/(\d+)', '\Module\Auth\Controller\Role::update');
        Router::get('/Auth/Role/delete/(\d+)', '\Module\Auth\Controller\Role::delete');

        //更新权限接口列表
        Router::get('/Auth/Action/initX', '\Module\Auth\Controller\Action::initDbX');
        //更新权限接口名称
        Router::mixed('/Auth/Action/update/(\d+)', '\Module\Auth\Controller\Action::update');

        //角色授予
        Router::get('/Auth/action/(\d+)', '\Module\Auth\Controller\Auth::action');
        Router::post('/Auth/actionAuthX', '\Module\Auth\Controller\Auth::actionAuthX');

        //用户授予
        Router::get('/Auth/user/(\d+)', '\Module\Auth\Controller\Auth::user');
        Router::post('/Auth/userAuthX', '\Module\Auth\Controller\Auth::userAuthX');

        //操作日志
        Router::get('/Auth/userLog', '\Module\Auth\Controller\UserLog::index');
    }
}