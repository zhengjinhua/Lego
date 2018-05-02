<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/9/7
 * Time: 23:17
 */
use Core\Config;

const _STATIC_URL_ = '//demo.test.com/';

Config::set('SYS_KEY', 'CWKKsx4g3Q8nsjvbY1iAtlkAWC1BHpsV');

//日志等级 选值范围: 1=INFO,2=DEBUG,4=ERROR
Config::set('LOG_LEVEL', 4);

//模块加载配置 默认:遍历模块目录
Config::set('MODULES', [
    'Admin',
    'Auth',
]);

//插件加载配置 默认:遍历插件目录
Config::set('PLUGINS', []);

//数据库
Config::set('DB', [
    'database_type' => 'mysql',
    'host' => 'database.test.com',
    'port' => 3306,
    'username' => 'root',
    'password' => 'test',
    'database_name' => 'demo',
]);

/*Config::set('CACHE', [
    'driver' => 'redis',
    'host' => 'database.test.com',
    'port' => 6379,
    'password' => 'test',
    'timeout' => 3,
    'db' => 1
]);*/

//菜单
Config::set('MENU', [
    '系统设置' => [
        'icon' => 'fa-wrench',
        'submenu' => [
            '帐号管理' => [
                'path' => '\Module\Admin\Controller\User::index',
                'ext' => [
                    '\Module\Admin\Controller\User::',
                    '\Module\Auth\Controller\Auth::user'
                ]
            ],
            '权限管理' => [
                'path' => '\Module\Auth\Controller\Role::index',
                'ext' => [
                    '\Module\Auth\Controller\Role::',
                    '\Module\Auth\Controller\Auth::',
                ]
            ],
            '操作日志' => [
                'path' => '\Module\Auth\Controller\UserLog::index',
                'ext' => [

                ]
            ],
        ]
    ],

]);
