<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/30
 * Time: 9:48
 */

namespace Module\Gii;

use Core\ModuleInterface;
use Core\Router;

class Module implements ModuleInterface
{
    public static function init()
    {
        Router::get('/gii', function () {
            (new Controller\Gii)->run('index', []);
        });
        Router::mixed('/gii/curd', function () {
            (new Controller\Gii)->run('generateCurd', []);
        });
        Router::mixed('/gii/model', function () {
            (new Controller\Gii)->run('generateModel', []);
        });
    }
}