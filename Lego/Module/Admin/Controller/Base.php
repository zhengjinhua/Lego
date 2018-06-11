<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/4
 * Time: 13:11
 */

namespace Module\Admin\Controller;

use Util\Util;
use Core\Config;
use Core\Controller;

class Base extends Controller
{
    public function __construct()
    {
        //登录验证
        if (!isset($_SESSION['user'])) {
            if (Util::isAjax()) {
                die('{"error":10000}');
            } else {
                Util::redirect('/');
            }
        }

        //菜单
        $this->assign('menu', Config::get('MENU'));

    }

}