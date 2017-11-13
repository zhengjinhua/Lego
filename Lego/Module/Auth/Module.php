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
        Router::get('/auth/role/index', '\Module\Auth\Controller\Role::index');
        Router::mixed('/auth/role/add', '\Module\Auth\Controller\Role::add');
        Router::mixed('/auth/role/update/(\d+)', '\Module\Auth\Controller\Role::update');
        Router::get('/auth/role/delete/(\d+)', '\Module\Auth\Controller\Role::delete');

        //更新权限接口列表
        Router::get('/auth/action/initX', '\Module\Auth\Controller\Action::initDbX');
        //更新权限接口名称
        Router::post('/auth/action/nameX', '\Module\Auth\Controller\Action::setNameX');

        //角色授予
        Router::get('/auth/action/(\d+)', '\Module\Auth\Controller\Auth::action');
        Router::post('/auth/actionAuthX', '\Module\Auth\Controller\Auth::actionAuthX');

        //用户授予
        Router::get('/auth/user/(\d+)', '\Module\Auth\Controller\Auth::user');
        Router::post('/auth/userAuthX', '\Module\Auth\Controller\Auth::userAuthX');

        //操作日志
        Router::get('/auth/userLog', '\Module\Auth\Controller\UserLog::index');
    }
}