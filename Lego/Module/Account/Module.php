<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/4
 * Time: 13:17
 */

namespace Module\Account;

use Core\ModuleInterface;
use Core\Router;

/**
 * 帐号管理模块
 * @package Module\Account
 */
class Module implements ModuleInterface
{
    public static function init()
    {
        Router::get('/', '\Module\Account\Controller\Index::index');
        Router::get('/logout', '\Module\Account\Controller\Index::logout');
        Router::post('/loginX', '\Module\Account\Controller\Index::login');

        Router::get('/home', '\Module\Account\Controller\Home::index');

        Router::get('/account/index', '\Module\Account\Controller\User::index');
        Router::get('/account/delete/(\d+)', '\Module\Account\Controller\User::delete');
        Router::mixed('/account/add', '\Module\Account\Controller\User::add');
        Router::mixed('/account/update/(\d+)', '\Module\Account\Controller\User::update');
    }
}