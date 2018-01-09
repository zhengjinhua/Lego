<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/4
 * Time: 13:17
 */

namespace Module\Admin;

use Core\Router;
use Core\ModuleInterface;

/**
 * 帐号管理模块
 * @package Module\Admin
 */
class Module implements ModuleInterface
{
    public static function init()
    {
        Router::get('/Admin/User/index', '\Module\Admin\Controller\User::index');
        Router::get('/Admin/User/delete/(\d+)', '\Module\Admin\Controller\User::delete');
        Router::mixed('/Admin/User/add', '\Module\Admin\Controller\User::add');
        Router::mixed('/Admin/User/update/(\d+)', '\Module\Admin\Controller\User::update');

        Router::get('/', function () {
            (new Controller\Index)->run('index', []);
        });
        Router::post('/loginX', function () {
            (new Controller\Index)->run('login', []);
        });
        Router::get('/logout', function () {
            (new Controller\Index)->run('logout', []);
        });

        Router::get('/home', function () {
            (new Controller\Home)->run('index', []);
        });
        Router::mixed('/home/password', function () {
            (new Controller\Home)->run('password', []);
        });

    }
}