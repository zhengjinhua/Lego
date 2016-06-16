<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/9/7
 * Time: 23:17
 */
use Core\Config;

//数据库
Config::set('DB', [
    'database_type' => 'mysql',
    'host' => '127.0.0.1',
    'port' => 3306,
    'username' => 'root',
    'password' => '',
    'database_name' => 'passport',
    'slave' => [
        'database_type' => 'mysql',
        'host' => '127.0.0.1',
        'port' => 3306,
        'username' => 'root',
        'password' => '',
        'database_name' => 'passport'
    ]
]);