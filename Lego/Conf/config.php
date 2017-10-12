<?php
/**
 * Created by PhpStorm.
 * User: zheng
 * Date: 15/8/13
 * Time: 16:46
 */
use Core\Config;

Config::set('SYS_KEY', 'CWKKsx4g3Q8nsjvbY1iAtlkAWC1BHpsV');

//日志等级 选值范围: 1=INFO,2=DEBUG,4=ERROR
Config::set('LOG_LEVEL', 4);

//缓存
Config::set('CACHE', ['driver' => 'file']);
//Config::set('CACHE', ['driver' => 'redis','host'=>'data.test.com','port'=>6379,'timeout'=>3,'db'=>0]);

//数据库
/*Config::set('DB', [
    'database_type' => 'mysql',
    'host' => '127.0.0.1',
    'port' => 3306,
    'username' => 'root',
    'password' => '',
    'database_name' => 'passport',
    'table_pre' => '',
    'charset' => '',
    'option' => [],
    'slave' => [
        'database_type' => 'mysql',
        'host' => '127.0.0.1',
        'port' => 3306,
        'username' => 'root',
        'password' => '',
        'database_name' => 'passport',
        'table_pre' => '',
        'charset' => '',
        'option' => [],
    ]
]);*/

//模块加载配置 默认:遍历模块目录
Config::set('MODULES', []);

//插件加载配置 默认:遍历插件目录
Config::set('PLUGINS', []);
