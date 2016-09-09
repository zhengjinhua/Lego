<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/24
 * Time: 15:22
 */

namespace Module\Account;

use Core\ModuleInterface;
use Core\Router;

/**
 * 帐号模块
 * @package Module\Account
 */
class Module implements ModuleInterface
{
    public static function init()
    {
        Router::get('/', '\Module\Account\Controller\Index::login');
        Router::get('/reg', '\Module\Account\Controller\Index::reg');
        Router::get('/logout', '\Module\Account\Controller\Index::logout');
        Router::post('/loginX', '\Module\Account\Controller\Index::loginX');
        Router::post('/regX', '\Module\Account\Controller\Index::regX');

        Router::get('/user/home', '\Module\Account\Controller\User::index');
        Router::mixed('/user/password', '\Module\Account\Controller\User::modifyPassword');
        Router::mixed('/user/email', '\Module\Account\Controller\User::modifyEmail');
        Router::mixed('/user/mobile', '\Module\Account\Controller\User::modifyMobile');
        Router::mixed('/user/info', '\Module\Account\Controller\User::modifyInfo');

    }

}
