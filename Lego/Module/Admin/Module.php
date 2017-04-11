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
        Router::get('/account/index', '\Module\Admin\Controller\User::index');
        Router::get('/account/delete/(\d+)', '\Module\Admin\Controller\User::delete');
        Router::mixed('/account/add', '\Module\Admin\Controller\User::add');
        Router::mixed('/account/update/(\d+)', '\Module\Admin\Controller\User::update');

        //ajax检查用户是否存在
        Router::get('/account/ajaxUsername', function () {
            (new Controller\User)->run('ajaxUsername', []);
        });
        //管理员操作日志
        Router::get('/auth/userLog', '\Module\Admin\Controller\AuthUserLog::index');

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
        Router::mixed('/home/memberInfo', function () {
            (new Controller\Home)->run('memberInfo', []);
        });
        Router::get('/home/passwordAjax', function () {
            (new Controller\Home)->run('passwordAjax', []);
        });
        Router::get('/home/emailAjax', function () {
            (new Controller\Home)->run('emailAjax', []);
        });

    }
}